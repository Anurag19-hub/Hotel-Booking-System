//general_data var ma site_title and site_about ma je data already hase aene fetch kravisu
let general_data, contacts_data;

let general_s_form = document.getElementById('general_s_form');
let site_title_input = document.getElementById('site_title_input');
let site_about_input = document.getElementById('site_about_input');     

let contacts_s_form = document.getElementById('contacts_s_form');

let team_s_form = document.getElementById('team_s_form');
let member_name_inp = document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');


function get_general()
{
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');        
    let shutdown_toggle = document.getElementById('shutdown-toggle');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);                                    
    xhr.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');            
    

    xhr.onload = function(){
        
        general_data = JSON.parse(this.responseText);
        //console.log(general_data);

        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_input.value = general_data.site_title;
        site_about_input.value = general_data.site_about;
        
        if(general_data.shutdown == 0){

            shutdown_toggle.checked = false;
            shutdown_toggle.value = 0;
        }
        else{

            shutdown_toggle.checked = true;
            shutdown_toggle.value = 1;
        }
    }

    xhr.send('get_general');
}
        

general_s_form.addEventListener('submit', function(e){

    e.preventDefault();
    upd_general(site_title_input.value, site_about_input.value);
});



function upd_general(site_title_val, site_about_val)
{
    let xhr = new XMLHttpRequest();

    /*"POST" = This specifies the HTTP method to be used for the request. In this case, 
    it's a POST request, which is typically used to send data to the server.*/
    xhr.open("POST", "ajax/setting_crud.php", true);

    /*'application/x-www-form-urlencoded' is a common content type used POST method for sending form 
    data to the server.*/
    xhr.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        
        var myModal = document.getElementById('general-setting');
        var modal = bootstrap.Modal.getInstance(myModal);
        //console.log(this.responseText);

        modal.hide();

        if(this.responseText == 1)
        {
            //console.log('Data Updated');

            alert('success','changes saved!');
            get_general();
        }
        else
        {
            //console.log('No changed in data');

            alert('error','No changes made!');
        }
    }          
    /*xhr.send('get_general');: This line sends the actual data with the request. 
    In this case, you are sending the string 'get_general'. 
    This data will be included in the request body. */
    xhr.send('site_title='+site_title_val + '&site_about='+site_about_val+ '&upd_general' );
}

function upd_shutdown(val){
    
    let xhr = new XMLHttpRequest();
    
    xhr.open("POST", "ajax/setting_crud.php", true);

    xhr.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');            

    xhr.onload = function(){                                

        if(this.responseText == 1 && general_data.shutdown == 0)
        {                    

            alert('success','Site has been shutdown!');
        }
        else
        {                 

            alert('success','Shutdown mode off!');
        }
        get_general();
    }
                
    xhr.send('upd_shutdown=' + val);

}


function get_contacts()
{            
    let contacts_p_id = ['address','gmap','pn1','pn2','email','fb','insta','tw'];
    let iframe = document.getElementById('iframe');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
                        
        contacts_data = JSON.parse(this.responseText);
        //console.log(contacts_data);

        contacts_data = Object.values(contacts_data);
        //console.log(contacts_data);

            for(i=0; i<contacts_p_id.length; i++){

            document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
            }
            iframe.src = contacts_data[9];
            //console.log(contacts_p_id);
            contacts_inp(contacts_data);
            //console.log(contacts_data);
    }
    xhr.send('get_contacts');
}

function contacts_inp(data)
{
    let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','pn2_inp','email_inp','fb_inp','insta_inp','tw_inp','iframe_inp'];
    
    //document.getElementById(address_inp).values;
    for(i=0; i<contacts_inp_id.length; i++){

        document.getElementById(contacts_inp_id[i]).value = data[i+1];
        //console.log(contacts_inp_id[i]).values;
        //console.log(data[i+1]);
    }
}

contacts_s_form.addEventListener('submit', function(e){

    e.preventDefault();
    upd_contacts();
});

function upd_contacts()
{
    
    let index = ['address','gmap','pn1','pn2','email','fb','insta','tw','iframe'];
    let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','pn2_inp','email_inp','fb_inp','insta_inp','tw_inp','iframe_inp'];
    let data_str = "";
    
    for(i=0; i<index.length; i++)
    {
        data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';                
    }
    //console.log(data_str);

    data_str += "upd_contacts";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        
        var myModal = document.getElementById('contacts-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 1)
        {
            alert('success', 'Changes saved');
            get_contacts();
        }
        else
        {
            alert('error', 'Changes not saved');
        }
    }
    xhr.send(data_str);
}


team_s_form.addEventListener('submit', function(e){
    
    //it prevent the default behaviour of form like refreshing the page and being submitted.
    //so it stopped to refreshing the form.        
    e.preventDefault();
    add_member();
});

function add_member()
{
// FormData is an interface. we can make an Object of it and by taking help of it we can use send function 
// which is used to send any files and image file to the server.

    let data = new FormData();
    data.append('name', member_name_inp.value);
    data.append('picture', member_picture_inp.files[0]);
    //file[0] nu matlab ki user ae bau badhi image aek sathe select kri hoi but badhi aek sathe na karava mte aano use thai
    // it sends only first selected file.
    data.append('add_member', '');

    let xhr = new XMLHttpRequest();            
    xhr.open("POST", "ajax/setting_crud.php", true);
    
    xhr.onload = function(){
        
        //console.log(this.responseText);
        var myModal = document.getElementById('team-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 'inv_img')
        {
            alert('error', 'Only JPG and PNG images are allowed!');
        }
        else if(this.responseText == 'inv_size')
        {
            alert('error', 'Image should be less than 2MB!');
        }
        else if(this.responseText == 'upd_failed')
        {
            alert('error', 'Image upload failed. Server Down');
        }
        else
        {                    
            alert('success','New Member Added');
            member_name_inp.value = '';
            member_picture_inp.value = '';

            get_members();
        }
    }                      
    xhr.send(data);
}

function get_members()
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);                                    
    xhr.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');            
    
    xhr.onload = function(){

        document.getElementById('team-data').innerHTML = this.responseText;
    }

    xhr.send('get_members');
}


function rem_member(val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);                                    
    xhr.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');            
    

    xhr.onload = function(){

        if(this.responseText == 1)
        {
            alert('success', 'Member Removed!');
            get_members();
        }
        else
        {
            alert('error', 'Server Down!');
        }
    }
    xhr.send('rem_member='+ val);
}

window.onload = function(){

    get_general();
    get_contacts();
    get_members();
}
