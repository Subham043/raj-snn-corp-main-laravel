<?php

namespace App\Modules\Enquiries\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiries\Services\EnquiryService;

class EnquiryDeleteController extends Controller
{
    private $enquiryService;

    public function __construct(EnquiryService $enquiryService)
    {
        $this->enquiryService = $enquiryService;
    }

    public function get(Int $id){
        $data = $this->enquiryService->getById($id);
        try {
            //code...
            $this->enquiryService->delete($data);
            return redirect()->intended(route('enquiry_list.get'))->with('success_status', 'Enquiry deleted successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('enquiry_list.get'))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
