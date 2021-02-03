$(document).ready(function () {
    $('#btnRegister').click(function (e) {
            e.preventDefault();
            const fullName = $("#full_name").val().trim();
            const email = $("#email").val().trim();
            const password = $("#password").val().trim();
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            const apiEndpoint = "http://localhost/basic-web-development-website-and-cms/cms/register_logic.php";
            
            if(validatedInputs() != true){
                return false;
            }
           
            else{
                $.post(apiEndpoint, {
                'full_name': fullName,
                'email': email,
                'password': password
                }, function(response){
                if(response.success == false){
                    alert(response.message);
                }else{
                    $("#full_name").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $(".password").css("border-color", "#ced4da");
                    $("#password_message").text("");
                    $(".name").css("border-color", "#ced4da");
                    $(".email").css("border-color", "#ced4da");
                    $("small").text("You successfully Registered click below to login!").css("color", "green").css("font-weight", "bold"); 
                }
                });
                return false;
            }
    })           
});

function validatedInputs(){
    const fullName = $("#full_name").val().trim();
    const email = $("#email").val().trim();
    const inputedPassword = $("#password").val().trim();
    
        if(validateName(fullName) != true || validateEmail(email) != true || checkPassword(inputedPassword) != true)
            return false;
        else {
            return true;
        }
}
function validateName(name){
    if(name.length < 4){
        $(".name").css("border-color", "red");
        $("#name_message").text("Name is required!!").css("color", "red").css("font-size", "12px");
        return false;
    }
    else{
        $(".name").css("border-color", "green");
        $("#name_message").text("");
        return true;
    }

}
function validateEmail(email){
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if(email == "" || !email.match(emailPattern)){
        $(".email").css("border-color", "red");
        $("#email_message").text("Email is required!!").css("color", "red").css("font-size", "12px");
        return false;
    }
    else{
        $(".email").css("border-color", "green");
        $("#email_message").text("");
        return true;
    }

}

function login(){
    const email = $("#email").val();
    const password = $("#password").val();
      const apiEndpoint = "http://localhost/basic-web-development-website-and-cms/cms/login_logic.php";
      $.post(apiEndpoint, {
          'email': email,
          'password': password
      }, function(response){
          console.log(response);
          if(response.success == false){
              alert(response.message);
          }else{
              location.reload();
          }

      });
      return false;
  }


function checkPassword(password) { 
    var passwordTemplate = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    if(!password.match(passwordTemplate)) { 
        $(".password").css("border-color", "red");
        $("#password_message").text("Strong password is required!!").css("color", "red");
        return false;
    }
    else{ 
        $(".password").css("border-color", "green");
        $("#password_message").text("");
        return true;
       
    }
}



//timeline javascript
$("#logout").click(function(){
    const endPoint = "http://localhost/basic-web-development-website-and-cms/cms/signout.php";
    $.get(endPoint, function(response){
        location.reload();
    });
});

$(document).ready(function(){
    loadCategories();
});

function loadCategories(){
const categoryTemplate = 
        '<li class="list-group-item" id="id_line_{{id}}">'+
            '<div class="d-flex bd-highlight">'+
                '<div class="p-2 flex-grow-1">'+
                '<h5 class="card-title">{{category_name}}</h5>'+
            '</div>'+
            '<div class="d-flex bd-highlight p-2 flex-grow-1 middle">'+
                '<p class="card-title">10</p>'+
            '</div>'+
            '<div class="d-flex bd-highlight middle">'+
                '<div class="p-2">'+
                    '<button type="button" class="btn btn-danger delete" id="btndelete" onclick="deleteTask({{id}})">Delete</button>'+
                    '<button type="button" class="btn btn-secondary ms-2 edit" id="btnedit" onclick="update({{id}})">Edit</button>'+
                '</div>'+
        '</li>';
const endPoint = "http://localhost/basic-web-development-website-and-cms/cms/category_api.php";

$.get(endPoint, function(response){
    let category = "";
    for(let i = 0; i < response.data.length; i++){
        const currentCategory = response.data[i];
        category += categoryTemplate.replace("{{category_name}}", escapeHtml(currentCategory.category_name))
                        .replaceAll("{{id}}", currentCategory.id);           
    };
    $("#categoryList").html(category);
}); 
}

// function updateTask(idTask, idUser){
//     var new_status = $("#mySelect").val();
//     var id_task = idTask;
//     var id_user = idUser;

//     const apiEndpoint = "http://localhost/task_managment_project_web/update_task_logic.php";
//     if(confirm("Are you sure you want to update the status of this task?!")){
//         $.post(apiEndpoint, {
//             'id_task': id_task,
//             'status': new_status,
//             'id_user': idUser
//         }).done(function(response){ 
//             if(response.success == false){
//                 alert(response.message);
//             }else{
//                 $("option").value(new_status);
//             }
//         });
//         return false;
//     }else{
//         loadUserTasks();
//     }
// };


// function deleteTask(idTask, idUser){
// const apiEndpoint = "http://localhost/task_managment_project_web/delete_task_logic.php";
// const id_task = idTask;
// const id_user = idUser;
// if(confirm("Are you sure you want to delete this task?!")){
//     $.post(apiEndpoint, {
//         'id_task': id_task,
//         'id_user': id_user
//     }).done(function(response){ 
//         if(response.success == false){
//             alert(response.message);
//         }else{
//             $("#line_task_"+id_task).remove();
//         }
//     });
//     return false;
// }
// };
function storeCategory(){
const category_name = $("#category").val();
const apiEndpoint = "http://localhost/basic-web-development-website-and-cms/cms/category_logic.php";
    if(validateInputs() != true){
        return false;
    }
    
    else{
        $.post(apiEndpoint, {
            'category_name': category_name
            
        }).done(function(response){ 
            if(response.success == false){
                alert(response.message);
            }else{
                loadCategories();
                $('#exampleModal').modal('hide');
                $('#exampleModal').on('hidden.bs.modal', function () {
                    $(this).find("input").val('').end();
                });
            }
        });
        return false;
    }        
} 

function validateInputs(){
    const category_name = $("#category").val().trim();
    if(validateCategory(category_name) != true){
        return false;
    }
    else{
        return true;
    }
}

function validateCategory(category_name){
if(category_name.length < 5){
    $("#category").css("border-color", "red");
    $("#category_message").text("Category must be more than 4 charaters!!").css("color", "red").css("font-size", "12px");
    return false;

}else{
    $("#category").css("border-color", "green");
    $("#category_message").text("");
    return true;
}
}

function storePost(){
    const title = $("#title").val();
    const content = $("#content").val();
    const image = $("#image").val();
    const category = $("#category").val();

    const apiEndpoint = "http://localhost/basic-web-development-website-and-cms/cms/post_logic.php";
        if(validatePostInputs() != true){
            return false;
        }
        
        else{
            $.post(apiEndpoint, {
                'category_name': category_name
                
            }).done(function(response){ 
                if(response.success == false){
                    alert(response.message);
                }else{
                    loadCategories();
                    $('#exampleModal').modal('hide');
                    $('#exampleModal').on('hidden.bs.modal', function () {
                        $(this).find("input").val('').end();
                    });
                }
            });
            return false;
        }        
    } 
    
    function validatePostInputs(){
        const title = $("#title").val();
        const content = $("#content").val();
        const image = $("#image").val();


    if(validateTitle(title) != true || validateContent(content) != true || validateImageLink(image) != true){
        return false;
    }
    else{
        return true;
    }
    }

    function validateTitle(title){
        if(title.length < 5){
            $("#title").css("border-color", "red");
            $("#title_message").text("Title must be more than 4 charaters!!").css("color", "red").css("font-size", "12px");
            return false;
        
        }else{
            $("#title").css("border-color", "green");
            $("#title_message").text("");
            return true;
        }
        }
    function validateContent(content){
        if(content.length < 5){
            $("#content").css("border-color", "red");
            $("#content_message").text("Content must be more than 4 charaters!!").css("color", "red").css("font-size", "12px");
            return false;
            
        }else{
            $("#content").css("border-color", "green");
            $("#content_message").text("");
            return true;
         }
    }
    function validateImageLink(imgLink){
        if(imgLink == "" ){
            $("#image").css("border-color", "red");
            $("#image_message").text("Image link required!!").css("color", "red").css("font-size", "12px");
            return false;
            
        }else{
            $("#image").css("border-color", "green");
            $("#image_message").text("");
            return true;
         }
    }


function escapeHtml(str) {
var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
};
return str.replace(/[&<>"']/g, function(m) {
    return map[m];
});
}