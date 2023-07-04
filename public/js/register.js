const makeDay = document.getElementById('make_day');
const testDay = document.getElementById('test_day');
const age = document.getElementById('age');

makeDay.addEventListener('change', function() {
    testDay.min = makeDay.value; 
    calculateAge();
});

testDay.addEventListener('change', function() {
    makeDay.max = testDay.value;
    calculateAge();
});

function calculateAge() {
    const makeDate = new Date(makeDay.value);
    const testDate = new Date(testDay.value);

    const timeDiff = testDate.getTime() - makeDate.getTime();
    const days = timeDiff / (1000 * 3600 * 24);
    age.value = days;
}