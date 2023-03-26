<script>
    {!!$data->meta_footer!!}
</script>


<script type="text/javascript">

    // initialize the validation library
    const validation = new JustValidate('#contact-form', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validation
      .addField('#name', [
        {
          rule: 'required',
          errorMessage: 'Name is required',
        },
      ])
      .addField('#email', [
        {
          rule: 'required',
          errorMessage: 'Email is required',
        },
        {
          rule: 'email',
          errorMessage: 'Email is invalid',
        },
      ])
      .addField('#phone', [
        {
            rule: 'customRegexp',
            value: /^[0-9]*$/,
            errorMessage: 'Phone is invalid',
        },
      ])
      .onSuccess(async (event) => {
        event.target.preventDefault;
        var submitBtn = document.getElementById('submitBtn')
        submitBtn.innerHTML = loader_html
        submitBtn.disabled = true;
        try {
            var formData = new FormData();
            formData.append('name',document.getElementById('name').value)
            formData.append('email',document.getElementById('email').value)
            formData.append('phone',document.getElementById('phone').value)
            formData.append('page_url',document.getElementById('page_url').value)
            const response = await axios.post('{{route('enquiry_create.post')}}', formData)
            successToast(response.data.message)
            event.target.reset()
        } catch (error) {
            if(error?.response?.data?.errors?.name){
                errorToast(error?.response?.data?.errors?.name[0])
            }
            if(error?.response?.data?.errors?.email){
                errorToast(error?.response?.data?.errors?.email[0])
            }
            if(error?.response?.data?.errors?.phone){
                errorToast(error?.response?.data?.errors?.phone[0])
            }
            if(error?.response?.data?.error){
                errorToast(error?.response?.data?.error)
            }
        } finally{
            submitBtn.innerHTML =  `
                Submit
                `
            submitBtn.disabled = false;
        }
      });
</script>
<script type="text/javascript">

    // initialize the validation library
    const validation2 = new JustValidate('#banner-form', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validation2
      .addField('#name2', [
        {
          rule: 'required',
          errorMessage: 'Name is required',
        },
      ])
      .addField('#email2', [
        {
          rule: 'required',
          errorMessage: 'Email is required',
        },
        {
          rule: 'email',
          errorMessage: 'Email is invalid',
        },
      ])
      .addField('#phone2', [
        {
            rule: 'customRegexp',
            value: /^[0-9]*$/,
            errorMessage: 'Phone is invalid',
        },
      ])
      .onSuccess(async (event) => {
        event.target.preventDefault;
        var submitBtn = document.getElementById('submitBtn')
        submitBtn.innerHTML = loader_html
        submitBtn.disabled = true;
        try {
            var formData = new FormData();
            formData.append('name',document.getElementById('name2').value)
            formData.append('email',document.getElementById('email2').value)
            formData.append('phone',document.getElementById('phone2').value)
            formData.append('page_url',document.getElementById('page_url').value)
            const response = await axios.post('{{route('enquiry_create.post')}}', formData)
            successToast(response.data.message)
            event.target.reset()
        } catch (error) {
            if(error?.response?.data?.errors?.name){
                errorToast(error?.response?.data?.errors?.name[0])
            }
            if(error?.response?.data?.errors?.email){
                errorToast(error?.response?.data?.errors?.email[0])
            }
            if(error?.response?.data?.errors?.phone){
                errorToast(error?.response?.data?.errors?.phone[0])
            }
            if(error?.response?.data?.error){
                errorToast(error?.response?.data?.error)
            }
        } finally{
            submitBtn.innerHTML =  `
                Submit
                `
            submitBtn.disabled = false;
        }
      });
</script>
