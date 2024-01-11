function booking_analytics(period=1)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/dashboard.php", true);                                    
    xhr.setRequestHeader('Content-Type' , 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        
        let data = JSON.parse(this.responseText);
        console.log(data);
    }

    xhr.send('booking_analytics&period='+period);
}

window.onload = function(){

    booking_analytics();
}