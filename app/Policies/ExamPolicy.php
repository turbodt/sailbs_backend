<?php

namespace App\Policies;

use App\Exam;
use App\User;
use App\Certificate;

class ExamPolicy
{
    /**
     * Determine if the given exam can be read by user.
     *
     * @param  \App\User  $user
     * @param  \App\Exam  $exam
     * @return bool
     */
    public function read(User $user, Exam $exam)
    {
        return $user->certificates->contains($exam->certificate->id);
    }

    /**
     * Determine if the given exam can be done by user.
     *
     * @param  \App\User  $user
     * @param  \App\Exam  $exam
     * @return bool
     */
    public function correct(User $user, Exam $exam)
    {
        return self::read($user,$exam);
    }

    /**
     * Determine if an exam about given certificate can be generated by user.
     *
     * @param  \App\User  $user
     * @param  \App\Exam  $exam
     * @param  \App\Certificate $certificate
     * @return bool
     */
    public function generate(User $user, Exam $exam, Certificate $certificate)
    {
        return $user->certificates->contains($certificate->id);
    }

}