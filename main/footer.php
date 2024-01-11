<!--FOOTER-->

<div class="container-fluid bg-white mt-5">

<div class="row">
    <div class="col-lg-4 p-4">

        <h3 class="h-font fw-bold fs-3 mb-2"> <?php echo $setting_r['site_title'] ?> </h3>
        <p>
            <?php echo $setting_r['site_about'] ?> 
            
        </p>
    </div>

    <div class="col-lg-4 p-4">
        <h5 class="mb-3">Links</h5>
        <a href="index.php" class="d-inline-block mb-3 text-dark text-decoration-none">Home</a><br>
        <a href="rooms.php" class="d-inline-block mb-3 text-dark text-decoration-none">Rooms</a><br>
        <a href="facilities.php" class="d-inline-block mb-3 text-dark text-decoration-none">Facilities</a><br>
        <a href="contact.php" class="d-inline-block mb-3 text-dark text-decoration-none">Contact Us</a><br>
        <a href="about.php" class="d-inline-block mb-3 text-dark text-decoration-none">About Us</a>
    </div>

    <div class="col-lg-4 p-4">
        <h5 class="mb-3">Follow Us</h5>

        <?php

            if($contact_r['tw'] != "")
            {
                echo <<<data
                    <a href="$contact_r[tw]" class="d-inline-block text-dark text-decoration-none mb-2">
                        <i class="bi bi-twitter me-1"></i> Twitter
                    </a><br>
                data;
            }
        ?>

        <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark text-decoration-none mb-2">
            <i class="bi bi-facebook me-1"></i> Facebook
        </a><br>

        <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none">
            <i class="bi bi-instagram me-1"></i> Instagram
        </a><br>

    </div>
</div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">&COPY;Designed and Developed by Serenity Inn</h6>


<!-- BOOTSTRAP SCRIPT -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

    function alert(type,msg,position='body')
    {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                <strong class="me-3">${msg}</strong>                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        if(position == 'body')
        {
            document.body.append(element);
            element.classList.add('custom-alert');
        }
        else
        {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert,3000);
    }

    function remAlert(){
        document.getElementsByClassName('alert')[0].remove();
    }


    function setActive()
    {
        navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for(i=0; i<a_tags.length; i++)
        {

            let file = a_tags[i].href.split('/').pop(); //this line give us the file name of the page 
            //e.g. 'https://localhost/serenity/index.php =this is the whole url from that this line get us only index.php

            let file_name = file.split('.')[0]; // this will used to get the only file name as we get index.php from above line
            // this will split it in two parts [index][php]

            if(document.location.href.indexOf(file_name) >= 0)
            {
                a_tags[i].classList.add('active');
            }
        }
    }



    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit',(e)=>{

        e.preventDefault();

        let data = new FormData();

        data.append('email_username',login_form.elements['email_username'].value);
        data.append('pass',login_form.elements['pass'].value); 
        data.append('login','');


        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();            
        xhr.open("POST", "ajax/login_register.php", true);
    
        xhr.onload = function(){

            if(this.responseText == 'inv_email_username')
            {
                alert('error', 'invalid Email or Username');
            }
            else if(this.responseText == 'not_verified')
            {
                alert('error', 'Email is not verified');
            }
            else if(this.responseText == 'invalid_pass')
            {
                alert('error','Incorrect Password');
            }
            else
            {
                // alert('success','login done');
                let fileurl = window.location.href.split('/').pop().split('?').shift();
                if(fileurl == 'room_details.php'){

                    window.location = window.location.href;
                }
                else{
                    window.location = window.location.pathname;
                }
            }
        }                      
        xhr.send(data);
    });


    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit',(e)=>{

        e.preventDefault();

        let data = new FormData();

        data.append('fullname',register_form.elements['fullname'].value);
        data.append('username',register_form.elements['username'].value);
        data.append('email',register_form.elements['email'].value);
        data.append('password',register_form.elements['password'].value); 
        data.append('register','');


        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();            
        xhr.open("POST", "ajax/login_register.php", true);
    
        xhr.onload = function(){

            if(this.responseText == 'email_already')
            {
                alert('error', 'email is already registered');
            }
            else if(this.responseText == 'username_already')
            {
                alert('error', 'username is already registered');
            }
            else if(this.responseText == 'mail_failed')
            {
                alert('error', 'cannot send confirmation email! Server down');
            }
            else if(this.responseText == 'ins_failed')
            {
                alert('error','Registration failed');
            }
            else
            {
                alert('success','Registration successful. Confimation link sent to your email!');
                register_form.reset();
            }
        }                      
        xhr.send(data);
    });



    let forgot_form = document.getElementById('forgot-form');

    forgot_form.addEventListener('submit',(e)=>{

        e.preventDefault();

        let data = new FormData();

        data.append('email',forgot_form.elements['email'].value);
        data.append('forgot_pass','');


        var myModal = document.getElementById('forgotModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();            
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function(){

            if(this.responseText == 'inv_email')
            {
                alert('error', 'Invalid Email');
            }
            else if(this.responseText == 'not_verified')
            {
                alert('error', 'Email is not verified');
            }
            else if(this.responseText == 'mail_failed')
            {
                alert('error', 'cannot send confirmation email! Server down');
            }
            else
            {
                alert('success','Reset link sent to your email!');
                forgot_form.reset();
            }
        }                      
        xhr.send(data);
        });



        function checkLoginToBook(status,room_id)
        {
            if(status)
            {
                window.location.href='confirm_booking.php?id='+room_id;
            }
            else
            {
                alert('error','Please Login to book your room!');
            }
        }

    setActive();
</script>