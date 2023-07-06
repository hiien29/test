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

