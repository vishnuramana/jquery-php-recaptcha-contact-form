# ContactMe
A contact us form which uses jQuery, Google reCaptcha and PHP. This uses an ajax call which tells the user the status of the mail being sent. It also writes a log file in the server which helps debug failures.

## How to use:
1. Edit the `index.html` file by adding your site key provided by Google reCaptcha here :
  
      `<div class="g-recaptcha" data-sitekey="<site key goes here>" data-callback="onSubmit" data-theme="dark" data-size="invisible">`

2. Edit the `form.php` file by adding your secret key from Google reCaptcha and then other details such as the to email address.

    ` $secretKey = "<secret key goes here>";`
    
    `$to         = 'to@email.com';`
    
*Note: I was searching for a contact form which used Google reCaptcha and which had an ajax call as well. But I could not find the exact one which let me do it. SO I pieced together parts of code from stackoverflow and created this. Some parts of the code have been submitted by users of StackOverFlow, which I have modified and have used. The credits goes to the original author for those parts (I could not find the answers again, hence could not add the links to them here.).*

## License:
MIT
