<?php

namespace App\Modules\Enquiries\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiries\Services\EnquiryService;
use Illuminate\Http\Request;

class EnquiryPaginateController extends Controller
{
    private $enquiryService;

    public function __construct(EnquiryService $enquiryService)
    {
        $this->enquiryService = $enquiryService;
    }

    public function get(Request $request){
        $data = $this->enquiryService->paginate($request, 10);
        return view('admin.pages.enquiry.paginate')->with(
            [
                'data' => $data
            ]
        );
    }
}
