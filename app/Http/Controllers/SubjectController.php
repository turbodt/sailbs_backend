<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class SubjectController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function read(Request $request) {

        if ($request->user()->can('get',Subject::class)) {

            $subjects = Subject::all();

            return $this->jsonData($subjects);
        } else {
            $this->addError(1,'Not allowed.');
        }

        return $this->jsonData();

    }

    public function create(Request $request) {

        if ($request->user()->can('create',Subject::class)) {

            $request_data = null;
            if ($request->isJson()) {
                $request_data = $request->json()->all();
            } else {
                $request_data = $request->all();
            }

            $subject_data = isset($request_data['subject']) ? $request_data['subject'] : null;
            $subjects_data = isset($request_data['subjects']) ? $request_data['subjects'] : [];

            if (!empty($subject_data)) {
                $subjects_data[] = $subject_data;
            }

            $data = [];

            foreach ($subjects_data as $subject_data) {

                if (!isset($subject_data['code'])) {
                    $this->addError(1,'Invalid code for subject.',$subject_data);
                } else {

                    try {

                        $subject = new Subject();
                        $subject->code = $subject_data['code'];
                        $subject->name = isset($subject_data['name']) ? $subject_data['name'] : '';
                        $subject->short_name = isset($subject_data['short_name']) ? $subject_data['short_name']  : '';
                        $subject->description = isset($subject_data['description']) ? $subject_data['description']  : '';

                        $subject->save();

                        $certificates_data = isset($subject_data['certificates']) ? $subject_data['certificates']  : [];

                        foreach ($certificates_data as $certificate_data) {
                            $certificate_id = isset($certificate_data['id']) ? $certificate_data['id'] : null;
                            $certificate_code = isset($certificate_data['code']) ? $certificate_data['code'] : null;

                            $relation_data = [];
                            if (empty($certificate_id) && empty($certificate_code)) {
                                $this->addError(1,"Expected certificate's code or id not received.",$certificate_data);
                            } else {
                                if (empty($certificate_id)) {
                                    $certificate_id = Certificate::where('code', $certificate_code)->first()->id;
                                }

                                $relation_data[$certificate_id] = [
                                    'max_errors' => !empty($certificate_data['max_errors']) ? $certificate_data['max_errors'] : 0,
                                    'num_questions' => !empty($certificate_data['num_questions']) ? $certificate_data['num_questions'] : 0,
                                ];
                            }
                            $subject->certificates()->sync($relation_data);



                        }

                        $data[] = $subject->toArray();

                    } catch (\Exception $e) {
                        $this->addError(2, $e->getMessage());
                    }
                }
            }


            return $this->jsonData($data);
        } else {
            $this->addError(1,'Not allowed to create subjects.');
        }

        return $this->jsonData();
    }

    public function update(Request $request) {

        if ($request->user()->can('update',Subject::class)) {

            $request_data = null;
            if ($request->isJson()) {
                $request_data = $request->json()->all();
            } else {
                $request_data = $request->all();
            }

            $subject_data = isset($request_data['subject']) ? $request_data['subject'] : null;
            $subjects_data = isset($request_data['subjects']) ? $request_data['subjects'] : [];

            if (!empty($subject_data)) {
                $subjects_data[] = $subject_data;
            }

            $data = [];

            foreach ($subjects_data as $subject_data) {

                if (empty($subject_data['code']) && empty($subject_data['id'])) {
                    $this->addError(1,  'Expected subject\'s code or id not received.',$subject_data);
                } else {

                    $subject = null;
                    if (!empty($subject_data['id'])) {
                        $subject = Subject::where('id',$subject_data['id'])->first();
                    } else if (!empty($subject_data['code'])) {
                        $subject = Subject::where('code',$subject_data['code'])->first();
                    }

                    if (empty($subject)) {
                        $this->addError(1,  'Subject\'s code or id not found.',$subject_data);
                    } else {
                        try {

                            $subject->code = !empty($subject_data['code']) ? $subject_data['code'] : $subject->code;
                            $subject->name = !empty($subject_data['name']) ? $subject_data['name'] : $subject->name;
                            $subject->short_name = !empty($subject_data['short_name']) ? $subject_data['short_name'] : $subject->short_name;
                            $subject->description = !empty($subject_data['description']) ? $subject_data['description'] : $subject->description;

                            $subject->save();

                            $certificates_data = isset($subject_data['certificates']) ? $subject_data['certificates'] : [];

                            foreach ($certificates_data as $certificate_data) {
                                $certificate_id = isset($certificate_data['id']) ? $certificate_data['id'] : null;
                                $certificate_code = isset($certificate_data['code']) ? $certificate_data['code'] : null;

                                $relation_data = [];
                                if (empty($certificate_id) && empty($certificate_code)) {
                                    $this->addError(1, "Expected certificate's code or id not received.", $certificate_data);
                                } else {
                                    if (empty($certificate_id)) {
                                        $certificate_id = Certificate::where('code', $certificate_code)->first()->id;
                                    }

                                    $relation_data[$certificate_id] = [
                                        'max_errors' => !empty($certificate_data['max_errors']) ? $certificate_data['max_errors'] : 0,
                                        'num_questions' => !empty($certificate_data['num_questions']) ? $certificate_data['num_questions'] : 0,
                                    ];
                                }
                                $subject->certificates()->sync($relation_data);

                            }

                            $data[] = $subject->toArray();

                        } catch (\Exception $e) {
                            $this->addError(2, $e->getMessage());
                        }
                    }
                }
            }


            return $this->jsonData($data);
        } else {
            $this->addError(1,'Not allowed to update subjects.');
        }

        return $this->jsonData();
    }

    public function delete(Request $request) {

        if ($request->user()->can('delete',Subject::class)) {

            $request_data = null;
            if ($request->isJson()) {
                $request_data = $request->json()->all();
            } else {
                $request_data = $request->all();
            }

            $subject_id = isset($request_data['subject_id']) ? $request_data['subject_id'] : null;
            $subject_ids = isset($request_data['subject_ids']) ? $request_data['subject_ids'] : [];

            if (!empty($subject_id)) {
                $subject_ids[] = $subject_id;
            }


            $subject_code = isset($request_data['subject_code']) ? $request_data['subject_code'] : null;
            $subject_codes = isset($request_data['subject_codes']) ? $request_data['subject_codes'] : [];

            if (!empty($subject_code)) {
                $subject_codes[] = $subject_code;
            }

            try {
                Subject::destroy(collect($subject_ids));
            } catch (\Exception $e) {
                $this->addError(2, $e->getMessage());
            }

            try {
                Subject::whereIn('code',$subject_codes)->delete();
            } catch (\Exception $e) {
                $this->addError(2, $e->getMessage());
            }

            return $this->jsonData();
        } else {
            $this->addError(1,'Not allowed to delete subjects.');
        }

        return $this->jsonData();
    }

}
