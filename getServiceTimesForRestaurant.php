<?php
function getServiceTimesForRestaurant(Restaurant $restaurant, Carbon $date, $ignoreBookingDuration = false)
{
    // Initialize arrays to store booking times and filtered booking times
    $booking_times = [];
    $filtered_booking_times = [];

    // Initialize an array for opening hours
    $opening_hours = [];

    // Determine the day of the week from the provided date passed as a parameter to the method
    $day = $date->englishDayOfWeek;

    // Get the default booking time step in minutes 
    $step = $restaurant->default_booking_time_step_minutes;

    try {
        // Check if special service hours are active for the given date
        if ($ssh = $restaurant->inSpecialServiceHoursActive($date)) {
            // Get special service hours for the day and hide unnecessary fields
            $service_hours = $restaurant->specialServiceHours($day, $ssh->id)
                ->makeHidden('id', 'day', 'restaurant_id', 'created_at', 'updated_at');
        } else {
            // Get regular service hours for the day and hide unnecessary fields
            $service_hours = $restaurant->serviceHours($day)
                ->makeHidden('id', 'day', 'restaurant_id', 'created_at', 'updated_at');
        }
    } catch (\Throwable $th) {
        // If there is an error fetching service hours, return empty booking times
        return $booking_times;
    }

    $skip = []; // Initialize an array to skip certain times, if needed

    foreach ($service_hours as $service_hour) {
        $c++; // Increment counter 

        // Create Carbon instances for the opening and closing times
        $open = Carbon::createFromFormat('H:i:s', $service_hour->open);
        $close = Carbon::createFromFormat('H:i:s', $service_hour->close);

        // If the service hour enforces one sitting, add only the opening time
        if ($service_hour->enforce_one_sitting) {
            $booking_times[] = $open->format('H:i');
            continue; // Move to the next service hour
        }

        // If the ignoreBookingDuration flag is set, ignore booking duration
        if ($service_hour->ingore_booking_duration) {
            $ignoreBookingDuration = true;
        }

        // Adjust the closing time if it's the last service hour and booking duration should not be ignored
        if ($c == count($service_hours) && !$ignoreBookingDuration) {
            $close->subMinutes($restaurant->default_booking_duration_hours);
        }

        // Calculate the difference in minutes between opening and closing times
        $diff = $open->diffInMinutes($close);

        // Add the opening time to the booking times
        $booking_times[] = $open->format('H:i');

        // Generate booking times in steps until the closing time is reached
        while ($diff > 0 && ($close->format('i') == '59' || $open->copy()->addMinutes($step)->lte($close))) {
            $booking_times[] = $open->addMinutes($step)->format('H:i');
            $diff -= $step;
        }
    }

    // If the date is today, filter out booking times that are earlier than a specified threshold
    if ($date->isToday()) {
        $firstBookingTime = Carbon::now()->addMinutes($restaurant->widget_booking_minutes_before);
        foreach ($booking_times as $idx => $bt) {
            $bt_carbon = Carbon::createFromTimeString($bt);
            if ($firstBookingTime >= $bt_carbon) {
                unset($booking_times[$idx]);
            }
        }
    }

    // Remove duplicate booking times and reindex the array
    $booking_times = array_unique($booking_times);
    $booking_times = array_values($booking_times);

    // Remove the last time if it's '00:00'
    if (end($booking_times) == '00:00') {
        array_pop($booking_times);
    }

    // Sort booking times in ascending order
    sort($booking_times);

    // Return the array of booking times
    return $booking_times;
}
