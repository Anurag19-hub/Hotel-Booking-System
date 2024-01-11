<?php

    require('stripe-php-master/init.php');

    //Publishable key

    $publishablekey = "pk_test_51ONx1XLcrE6APjra6RZ4og7rRqK6IVaQUqtHv1Sp0OsWf44fXoe2CS7WdLXNFLrxpkHUqeUJNznB01YObFacerBJ00xvq5zuF9";

    //Secret key

    $secretkey = "sk_test_51ONx1XLcrE6APjrafUiY13dujmBIkOQbA5oSWhFmqCfIqeuOzr4mzxaccGKL4SE1qJ5MVsAzKtgUhzqf8wIrn4G500la1fKZwz";


    //For save keys
    \Stripe\Stripe::setApiKey($secretkey);
?>

    