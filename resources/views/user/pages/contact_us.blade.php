@extends('user.layouts.master')


@section('user_content')
   <div class="bd-example">
            <div class="row  row-cols-1 row-cols-md-1 g-4">
                <div class="col">
                    <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Contact</h2>

                        <hr>
                            <div class="col-md-12 d-flex justify-content-center">

                                 <div class="col-md-8 mt-5">
                                    <div class="card">
                                       <div class="card-body">
                                           <div  class="contact-bx ajax-form"  >
                                                      <input type="hidden" id="token" value="{{ @csrf_token() }}">
                                            
                                                      <div id="res" ></div>
                                                    <div class="ajax-message"></div>
                                          <div class="auth-form">
                                                <h2 class="text-center mb-4">Send Message</h2>
                                               
                                                 
                                                   <p>Contact Us for any queries</p>
                                                   
                                                   <div class="row">
                                                      <div class="col-md-6 mb-4">
                                                          <div class="form-floating mb-3">
                                                                <input id="name" type="text" class="form-control" name="name" readonly value="{{Auth::user()->name}}" required autocomplete="name" autofocus>
                                                                <label for="firstName"></label>
                                                               
                                                            </div>
                                                      </div>
                                                      <div class="col-md-6 mb-4">
                                                         <div class="form-floating mb-3">
                                                                <input id="user_name" type="text" class="form-control" readonly name="user_name" value="{{Auth::user()->user_name}}" required autocomplete="suer_name" autofocus>
                                                                <label for="lastName">Username</label>
                                                                
                                                         </div>
                                                      </div>
                                                   </div>





                                                   <div class="row">
                                                      <div class="col-md-6 mb-4">
                                                          <div class="form-floating mb-3">
                                                                <input readonly id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
                                                                <label for="floatingInput">Email</label>
                                                               
                                                            </div>
                                                      </div>
                                                      <div class="col-md-6 mb-4">
                                                          <div class="form-floating mb-3">
                                                                <input id="phone" name="phone" type="text" class="form-control"   required autocomplete="sponsor" required>
                                                                <label for="floatingInput">Phone Number</label>
                                                              
                                                            </div>
                                                      </div>


                                                   </div>
                                                   <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="form-floating mb-2">
                                                                 <textarea id="message" name="message" id="message" rows="4" class="form-control" required></textarea>
                                                                <label for="Password">Message</label>
                                                               
                                                            </div>
                                                      </div>
                                                    
                                                   </div>
                                                   
                                                 
                                                  
                                                   <div class="text-center">
                                                      <button name="submit" value="Submit" onclick="addData()" type="submit" class="btn btn-primary">Submit</button>
                                                   </div>

                                               

                                             </div>
                                             </div>
                                       </div>
                                    </div>
                                 </div>
                               </div>








                    </div>

                    </div>
                </div>


            </div>
        </div>

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  $.ajaxSetup({
      'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
  })
  //product view modal
  function clearData()
  {
    var name=$('#name').val('');
    var email=$('#email').val('');
    var user_name=$('#user_name').val('');
    var phone=$('#phone').val('');
    var message=$('#message').val('');
  }
  function addData()
  {
    var name=$('#name').val();
    var user_name=$('#user_name').val();
    var email=$('#email').val();
    var phone=$('#phone').val();
    var message=$('#message').val();

    $.ajax({
      type:"POST",
      dataType:"json",
      data:{name:name,user_name:user_name,email:email,phone:phone,message:message},
      url:"/contact/store",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success:function(data)
      {
        clearData();
        let timerInterval
            Swal.fire({
              title: 'Message Sent!',
              html: 'I will close in <b></b> milliseconds.',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                }, 100)
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {
              / Read more about handling dismissals below /
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
              }
            })
             console.log('successfully data added');
      }
    })
  }
  //add to cart

</script>


@endpush


@endsection
