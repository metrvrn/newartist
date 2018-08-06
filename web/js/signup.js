(function(){
    var signupButton = document.getElementById('signupButton');
    var privacyCheckbox = document.getElementById('privacyCheckbox');

    signupButton.disabled = true;

    privacyCheckbox.addEventListener('change', function(e){
        signupButton.disabled = !privacyCheckbox.checked;
    })
})()