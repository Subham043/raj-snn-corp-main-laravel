<?php

namespace App\Modules\Enquiries\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiries\Requests\EnquiryRequest;
use App\Modules\Enquiries\Services\EnquiryService;

class EnquiryCreateController extends Controller
{
    private $enquiryService;

    public function __construct(EnquiryService $enquiryService)
    {
        $this->enquiryService = $enquiryService;
    }

    public function get(){
        return view('admin.pages.projects.create');
    }

    public function post(EnquiryRequest $request){

        try {
            //code...
            $this->enquiryService->create($request);
            return response()->json(['message'=>'Enquiry created successfully.'], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['message'=>'Oops! Something went wrong. Please try again!'], 400);
        }

    }
}
