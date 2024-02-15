$(document).ready(function() {

    let registro=document.getElementsByName('record')[0].value;
    console.log(registro);
    if(registro ==''){
      var id=document.getElementById('assigned_user_id').value;
        setTimeout(function() {
            SugarWidgetScheduleRow.deleteRow(id);
        }, 450);
    
      }
      hideContactsDelayed();
  });


  function hideContactsDelayed() {
    setTimeout(function() {
      var addUser = document.getElementById('create-invitees');
      if (addUser) {
        addUser.style.display = 'none';
      }
    }, 500); 
  }
  
  

