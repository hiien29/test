const makeDay = document.getElementById('make_day');
const testDay = document.getElementById('test_day');
const age = document.getElementById('age');



//日付入力時に終了日（試験日）が開始日（打設日）より前の日付を選択できないようにする。その逆も
makeDay.addEventListener('change', function() {
    testDay.min = makeDay.value; 
    calculateAge();
});

testDay.addEventListener('change', function() {
    makeDay.max = testDay.value;
    calculateAge();
});
//日数が自動で表示されるようにする
function calculateAge() {
    const makeDate = new Date(makeDay.value);
    const testDate = new Date(testDay.value);

    const timeDiff = testDate.getTime() - makeDate.getTime();
    const days = timeDiff / (1000 * 3600 * 24);
    age.value = days;
}


// 削除時のすいーとアラート
// const deleteLinks = document.querySelectorAll('.delete');
// deleteLinks.forEach(link => {
//     link.addEventListener('click', function(event) {
//         event.preventDefault(); 

//         const deleteUrl = link.getAttribute('data-url');

//         Swal.fire({
//             title: '本当に削除しますか？',
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#aaa',
//             confirmButtonText: 'OK',
//             cancelButtonText: 'キャンセル'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 Swal.fire({
//                 title:'削除しました',
//                 icon:'success'
//             }).then(() => {
//                     window.location.href = deleteUrl;
//                 });
//             }
//         });
//     });
// });

function Delete(link) {
    var deleteUrl = link.getAttribute('data-url');
    Swal.fire({
        title: '本当に削除しますか？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'OK',
        cancelButtonText: 'キャンセル'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title:'削除しました',
                icon:'success'
            }).then(() => {
                window.location.href = deleteUrl;
            });
        }
        });
}


// 編集時のスイートアラート
function Update() {
    Swal.fire({
    title: '変更しますか？',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#aaa',
    confirmButtonText: 'OK',
    cancelButtonText: 'キャンセル'
}).then((result) => {
    if (result.isConfirmed) {
        Swal.fire({
            title:'変更を実行します',
            text:'不備がなければ、一覧ページに戻ります',
            icon:'success'
        }).then(() => {
            document.getElementById('updateForm').submit();
        });
    }
    });
}  

//登録時のスイートアラート

function Register() {
    Swal.fire({
        title: '登録しますか？',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'OK',
        cancelButtonText: 'キャンセル'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title:'登録を実行します',
                icon:'success'
            }).then(() => {
                document.getElementById('registerForm').submit();
            });
        }
        });
}

