

function validation(){
    var comments = document.getElementsByClassName('replyComment').value;
    document.getElementById('error').className = 'error';
    // document.getElementById('replyButton').disabled = true;
    if(comments === ''){
        // error.className = 'alert alert-danger';
        // error.innerHTML = '* Required';
        //

        document.getElementsByClassName('replyButton').disabled = true;
        return false;
    }
}
