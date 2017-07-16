<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
    'numeric' => 'The :attribute must be between :min and :max.',
    'file'    => 'The :attribute must be between :min and :max kilobytes.',
    'string'  => 'The :attribute must be between :min and :max characters.',
    'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid or deleted.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
    'numeric' => 'The :attribute may not be greater than :max.',
    'file'    => 'The :attribute may not be greater than :max kilobytes.',
    'string'  => 'The :attribute may not be greater than :max characters.',
    'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
    'numeric' => 'The :attribute must be at least :min.',
    'file'    => 'The :attribute must be at least :min kilobytes.',
    'string'  => 'The :attribute must be at least :min characters.',
    'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
    'numeric' => 'The :attribute must be :size.',
    'file'    => 'The :attribute must be :size kilobytes.',
    'string'  => 'The :attribute must be :size characters.',
    'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
    'attribute-name' => [
    'rule-name' => 'custom-message',
    ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
    'strDistDesc' => 'district name',
    'intDistID' => 'district',
    'strBaraDesc' => 'barangay name',
    'strCounFirstName' => 'first name',
    'strCounMiddleName' => 'middle name',
    'strCounLastName' => 'last name',
    'intCounDistID' => 'district',
    'strCounEmail' => 'councilor email',
    'strCounCell' => 'contact number',
    'strUserEmail' => 'email',
    'strSystDesc' => 'grade description',
    'dblSystHighGrade' => 'highest grade',
    'dblSystLowGrade' => 'lowest grade',
    'strSystFailGrade' => 'failing grade',
    'strSchoDesc' => 'school name',
    'intSystID' => 'academic grading',
    'strCourDesc' => 'course name',
    'strSemDesc' => 'semester description',
    'strYearDesc' => 'year description',
    'strBatcDesc' => 'batch name',
    'strStepDesc' => 'requirement description',
    'intStepDeadline' => 'days of completion',
    'intStepOrder' => 'order no.',
    'strTypeDesc' => 'budget description',
    'strUserFirstName' => 'first name',
    'strUserMiddleName' => 'middle name',
    'strUserLastName' => 'last name',
    'strUserEmail' => 'email',
    'strUserCell' => 'contact number',
    'strApplPicture' => 'image',
    'datPersDOB' => 'birth date',
    'intCounID' => 'councilor',
    'strApplHouseNo' => 'house number',
    'strPersStreet' => 'street',
    'intBaraID' => 'barangay',
    'strPersPOB' => 'place of birth',
    'strPersReligion' => 'religion',
    'PersGender' => 'gender',
    'intPersBrothers' => 'no. of brother/s',
    'intPersSisters' => 'no. of sister/s',
    'strPersOrganization' => 'organization',
    'strPersPosition' => 'position',
    'strPersDateParticipation' => 'date of participation',
    'motherlname' => "mother's last name",
    'motherfname' => "mother's first name",
    'mothercitizen' => "mother's citizenship",
    'motherhea' => "mother's highest education",
    'motheroccupation' => "mother's occupation",
    'motherincome' => "mother's income",
    'fatherlname' => "father's last name",
    'fatherfname' => "father's first name",
    'fathercitizen' => "father's citizenship",
    'fatherhea' => "father's highest education",
    'fatheroccupation' => "father's occupation",
    'fatherincome' => "father's income",
    'elemschool' => 'elementary name',
    'elemenrolled' => 'elementary date enrolled',
    'elemgrad' => 'elementary date graduated',
    'elemhonors' => 'elementary honor',
    'hsschool' => 'highschool name',
    'hsenrolled' => 'highschool date enrolled',
    'hsgrad' => 'highschool date graduated',
    'hshonors' => 'highschool honor',
    'strSiblFirstName' => "sibling's first name",
    'strSiblLastName' => "sibling's last name",
    'strSiblDateFrom' => "sibling's date from",
    'strSiblDateTo' => "sibling's date to",
    'school1' => 'first school',
    'course1' => 'first course',
    'school2' => 'second school',
    'course2' => 'second course',
    'school3' => 'third school',
    'course3' => 'third course',
    'intPersCurrentSchool' => 'current school',
    'intPersCurrentCourse' => 'current course',
    'strPersGwa' => 'gwa',
    'strApplGrades' => 'grade upload',
    'title' => 'subject',
    // 'description' => 'message',
    'receiver' => 'send to',
    'time_from' => 'from',
    'time_to' => 'to',
    'date_held' => 'date',
    'place_held' => 'place',
    ],

    ];
