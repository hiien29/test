const nottaskBtn = document.getElementById('nottask_btn');
const notTask = document.getElementById('nottask');
const isNottaskVisible = false;

nottaskBtn.addEventListener('click',function(){
    if (notTask.classList.contains('table_outer')) {
        notTask.classList.toggle('show');
    } 
    
});

document.addEventListener('DOMContentLoaded', function() {
    notTask.classList.remove('show');
    isNottaskVisible = false;
});

