
const signInButton=document.getElementById('signInButton');
const logInBox=document.getElementById('logInbox');
const typeMngt=document.getElementById('typeMngt');


signInButton.addEventListener('click', function(){
    logInBox.style.display="block";
    typeMngt.style.display="none";
})