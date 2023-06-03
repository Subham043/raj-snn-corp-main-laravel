<?php

namespace App\Modules\Enquiries\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Http\Services\OtpService;
use App\Modules\Enquiries\Requests\EnquiryRequest;
use App\Modules\Enquiries\Requests\OtpFormRequest;
use App\Modules\Enquiries\Requests\ResendOtpFormRequest;
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
            $data = $this->enquiryService->create($request);
            (new OtpService)->sendOtp($data->phone, $data->otp);
            $uuid = (new DecryptService)->encryptId($data->id);
            return response()->json(["uuid" => $uuid, "link" => route('enquiry.verifyOtp', $uuid)], 201);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(['message'=>'Oops! Something went wrong. Please try again!'], 400);
        }

    }


    public function resendOtp(ResendOtpFormRequest $request){
        try {
            //code...
            $id = (new DecryptService)->decryptId($request->uuid);
            $data = $this->enquiryService->getById($id);
            $new_data = $this->enquiryService->update(
                [
                    'otp' => rand(1000,9999),
                ],
                $data
            );
            (new OtpService)->sendOtp($new_data->phone, $new_data->otp);
            return response()->json(["message" => "Otp sent successfully."], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => "Invalid uuid"], 400);
        }
    }

    public function verifyOtp(OtpFormRequest $request, $uuid){

        try {
            //code...
            $id = (new DecryptService)->decryptId($uuid);
            $data = $this->enquiryService->getById($id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => "Invalid uuid"], 400);
        }

        try {
            //code...
            if($request->otp===$data->otp){
                $this->enquiryService->update(
                    [
                        'otp' => rand(1000,9999),
                        'is_verified' => true,
                    ],
                    $data
                );
                return response()->json(["message" => "Enquiry recieved successfully."], 201);
            }
            return response()->json(["message" => "Invalid OTP. Please try again"], 400);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
