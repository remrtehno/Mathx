const axios = require('axios');

var id_inte;
function proverka (e, val) {

    let taskContainer = e.target.closest('.task');
    let answer = e.target.closest('div').querySelector('.otvet-kod').value;
    let checkAnswer = (val,compVal) => String(val).replace(/\s/g, '').split(':').find(x=>x===compVal.replace(/\s/g, ''));

    if (checkAnswer(val,answer)) {
        alert ('Верно!');

        let route = $("[name=\"save_meta_route\"]").val();
        let bdName = $("[name=\"name_db\"]").val();
        let idTask = $(e.target).data('id');
        let request = {key: {}, value:{}};
        request.key = 'user_tasks';
        request.value[bdName] = {id: idTask};

        (async (taskContainer) => {
            await axios.post(route, request).then( response => {
                $(taskContainer).animate({left: '250px', opacity: 0,}, 600, function() {
                    $(this).hide();
                });
            }).catch( ( error ) => {
                console.log( error );
            })
        })(taskContainer);

    } else {
        alert ('Неверно!');
    }
};

function tips(event, id) {
    event.preventDefault();

    if(id_inte) {
        alert ('У вас включен счетчик для другой задачи');
        return false;
    }


    var tag= event.target.closest('.task').querySelector('[class*="hints-"][style="display:none;"]');
    if(tag) {
        tag.style.display = 'block';

    }


    var timer = event.target.parentNode.querySelector('.timer');
    function timerFunc () {
        var totalSec = 200;
        id_inte = setInterval(function () {

            if(totalSec == 1) {
                clearInterval(id_inte);
                id_inte = null;
            }

            totalSec--;

            timer.innerHTML = totalSec;
        },1000);

    }

    timerFunc();

};


$('.check-answer').click(function () {
    event.preventDefault();
    var answer = $(this).data('answer');
    proverka(event, answer);
});
$('.steps').click(function (event) {
    let id = $(this).data('id');
    tips(event,id);
});



