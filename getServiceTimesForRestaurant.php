<?php
function getServiceTimesForRestaurant(Restaurant $restaurant, Carbon $date, $ignoreBookingDuration = false)
{
    // Initialize empty arrays to store booking times and filtered booking times
    $booking_times = [];
    $filtered_booking_times = [];

    // Initialize an array for opening hours
    $opening_hours = [];

    // Determine the day of the week from the provided date passed as a parameter to the method
    $day = $date->englishDayOfWeek;

    // Get the default booking time step in minutes 
    $step = $restaurant->default_booking_time_step_minutes;

    try {
        // Check if the restaurant inSpecialServiceHoursActive are active for the given date
        if ($ssh = $restaurant->inSpecialServiceHoursActive($date)) {
            // Get special service hours for the day and hide 'id', 'day', 'restaurant_id','created_at' and 'updated_at'
            $service_hours = $restaurant->specialServiceHours($day, $ssh->id)
                ->makeHidden('id', 'day', 'restaurant_id', 'created_at', 'updated_at');
        } else {
            // Get regular service hours for the day and hide 'id', 'day', 'restaurant_id','created_at' and 'updated_at'
            $service_hours = $restaurant->serviceHours($day)
                ->makeHidden('id', 'day', 'restaurant_id', 'created_at', 'updated_at');
        }
    } catch (\Throwable $th) {
        //return empty booking times if an exception occurs while fetching service hours
        return $booking_times;
    }

    $skip = []; // Initialize an array to skip certain times, if needed

    foreach ($service_hours as $service_hour) {
        $c++; // Increment counter (though i didn't see where $c was initialized)

        // Create a Carbon instance for the opening time using the 'H:i:s' format
        $open = Carbon::createFromFormat('H:i:s', $service_hour->open);

        // Create a Carbon instance for the closing time using the 'H:i:s' format
        $close = Carbon::createFromFormat('H:i:s', $service_hour->close);

        // If the service hour enforce_one_sitting, add only the opening time
        if ($service_hour->enforce_one_sitting) {
            $booking_times[] = $open->format('H:i');
            continue; // Move to the next service hour
        }

        // If the ignore_booking_duration flag is set, ignore booking duration
        //(this line will throw an error though, because ignore is wrongly spelt)
        if ($service_hour->ingore_booking_duration) {
            $ignoreBookingDuration = true;
        }

        // Adjust the closing time, if it's the last service hour and $ignoreBookingDuration is false
        if ($c == count($service_hours) && !$ignoreBookingDuration) {
            // Subtract the default booking duration from the closing time
            $close->subMinutes($restaurant->default_booking_duration_hours);
        }

        // Calculate the difference in minutes between opening and closing times
        $diff = $open->diffInMinutes($close);

        // Add the opening time to the booking_times array
        $booking_times[] = $open->format('H:i');

        // Loop while $diff > 0(time is remaining), and either the close time is at 59 minutes
        // or the next booking time, based on the restaurant default booking time, is <= to the close time.
        while ($diff > 0 && ($close->format('i') == '59' || $open->copy()->addMinutes($step)->lte($close))) {
            // Add the restaurant default booking time to the array, formatted as 'H:i'.
            $booking_times[] = $open->addMinutes($step)->format('H:i');

            // Subtract the step duration from the remaining time difference.
            $diff -= $step;
        }
    }

    // Check if the given date is today.
    if ($date->isToday()) {
        // Determine the earliest booking time allowed, which is the current time plus the restaurant widget_booking_minutes_before.
        $firstBookingTime = Carbon::now()->addMinutes($restaurant->widget_booking_minutes_before);

        // Iterate over the array of booking times.
        foreach ($booking_times as $idx => $bt) {
            // Convert the booking time string to a Carbon instance, for comparison.
            $bt_carbon = Carbon::createFromTimeString($bt);

            // If the earliest allowed booking time is greater than or equal to the current booking time, remove it from booking_times array
            if ($firstBookingTime >= $bt_carbon) {
                unset($booking_times[$idx]);
            }
        }
    }


    // Remove duplicate booking times from the array
    $booking_times = array_unique($booking_times);
    // Re-index the array to ensure the keys are sequential after removing duplicates
    $booking_times = array_values($booking_times);

    // Remove the last time if booking_times is '00:00'
    if (end($booking_times) == '00:00') {
        array_pop($booking_times);
    }

    // Sort booking_times in ascending order
    sort($booking_times);

    // Return the array of booking times
    return $booking_times;
}
