@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg profile-setting-img">
                <img src="{{ asset('main/images/hero/banner3.jpg')}}" class="profile-wid-img" alt="">
                <!-- <div class="overlay-content">
                    <div class="text-end p-3">
                        <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                            <input id="profile-foreground-img-file-input" type="file"
                                class="profile-foreground-img-file-input">
                            <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                            </label>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="row">

            <!--end col-->
            <div class="col-xxl-9 mt-5">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Personal Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="far fa-user"></i>
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="javascript:void(0);" id="profileForm">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="first_name"
                                                    placeholder="Enter your first name" value="{{Auth::user()->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="last_name"
                                                    placeholder="Enter your first name" value="{{Auth::user()->last_name}}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone
                                                    Number</label>
                                                <input type="text" class="form-control" id="phone"
                                                    placeholder="Enter your phone number" value="{{Auth::user()->phone}}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email
                                                    Address</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Enter your email" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary" id="submitBtn">Update</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <form action="javascript:void(0);" id="passwordForm">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="old_password" class="form-label">Old
                                                    Password*</label>
                                                <input type="password" class="form-control" name="old_password" id="old_password"
                                                    placeholder="Enter current password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="password" class="form-label">New
                                                    Password*</label>
                                                <input type="password" class="form-control" name="password" id="password"
                                                    placeholder="Enter new password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirm_password" class="form-label">Confirm
                                                    Password*</label>
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                                    placeholder="Confirm password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12 mt-3">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success" id="submitBtn2">Change
                                                    Password</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>

                            </div>
                            <!--end tab-pane-->

                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
</div><!-- End Page-content -->

@stop


@section('javascript')

<script type="text/javascript">

// initialize the validation library
const validation = new JustValidate('#profileForm', {
    errorFieldCssClass: 'is-invalid',
    focusInvalidField: true,
    lockForm: true,
});
// apply rules to form fields
validation
  .addField('#first_name', [
    {
      rule: 'required',
      errorMessage: 'First Name is required',
    },
    {
        rule: 'customRegexp',
        value: /^[a-zA-Z\s]*$/,
        errorMessage: 'First Name is invalid',
    },
  ])
  .addField('#last_name', [
    {
      rule: 'required',
      errorMessage: 'Last Name is required',
    },
    {
        rule: 'customRegexp',
        value: /^[a-zA-Z\s]*$/,
        errorMessage: 'Last Name is invalid',
    },
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('first_name',document.getElementById('first_name').value)
        formData.append('last_name',document.getElementById('last_name').value)
        formData.append('email',document.getElementById('email').value)
        formData.append('phone',document.getElementById('phone').value)
        const response = await axios.post('{{route('profile.post')}}', formData)
        successToast(response.data.message)
    }catch (error){
        if(error?.response?.data?.form_error?.first_name){
            errorToast(error?.response?.data?.form_error?.first_name[0])
        }
        if(error?.response?.data?.form_error?.last_name){
            errorToast(error?.response?.data?.form_error?.last_name[0])
        }
        if(error?.response?.data?.form_error?.email){
            errorToast(error?.response?.data?.form_error?.email[0])
        }
        if(error?.response?.data?.form_error?.phone){
            errorToast(error?.response?.data?.form_error?.phone[0])
        }
    }finally{
        submitBtn.innerHTML =  `
            Update
            `
        submitBtn.disabled = false;
    }
  })

  // initialize the validation library
const validationPassword = new JustValidate('#passwordForm', {
    errorFieldCssClass: 'is-invalid',
    focusInvalidField: true,
    lockForm: true,
});
// apply rules to form fields
validationPassword
.addField('#password', [
    {
      rule: 'required',
      errorMessage: 'Password is required',
    }
  ])
  .addField('#confirm_password', [
    {
      rule: 'required',
      errorMessage: 'Confirm Password is required',
    },
    {
        validator: (value, fields) => {
        if (fields['#password'] && fields['#password'].elem) {
            const repeatPasswordValue = fields['#password'].elem.value;

            return value === repeatPasswordValue;
        }

        return true;
        },
        errorMessage: 'Password and Confirm Password must be same',
    },
  ])
  .addField('#old_password', [
    {
      rule: 'required',
      errorMessage: 'Old Password is required',
    }
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn2')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('old_password',document.getElementById('old_password').value)
        formData.append('password',document.getElementById('password').value)
        formData.append('confirm_password',document.getElementById('confirm_password').value)
        formData.append('refreshUrl','{{URL::current()}}')
        const response = await axios.post('{{route('password.post')}}', formData)
        successToast(response.data.message)
    }catch (error){
        if(error?.response?.data?.form_error?.old_password){
            errorToast(error?.response?.data?.form_error?.old_password[0])
        }
        if(error?.response?.data?.form_error?.password){
            errorToast(error?.response?.data?.form_error?.password[0])
        }
        if(error?.response?.data?.form_error?.confirm_password){
            errorToast(error?.response?.data?.form_error?.confirm_password[0])
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Change Password
            `
        submitBtn.disabled = false;
    }
  })

</script>
@stop
