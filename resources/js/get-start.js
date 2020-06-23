const axios = require('axios');

var id_inte;
function proverka (e, val) {

    let taskContainer = e.target.closest('.task');
    let answer = e.target.closest('div').querySelector('.otvet-kod').value;
    let checkAnswer = (val,compVal) => String(val).replace(/\s/g, '').split(':').find(x=>x===compVal.replace(/\s/g, ''));
    let date = $('[name="date"]').val();

    if (checkAnswer(val,answer)) {
       // alert ('Верно!');
        $(taskContainer).find('.otvet-kod').css('border', '1px solid green');
        let route = $("[name=\"save_meta_route\"]").val();
        let bdName = $("[name=\"name_db\"]").val();
        let idTask = $(e.target).data('id');

        let request = {key: {}, value:{}};
        request.key = 'user_tasks';
        request.value[bdName] = {id: idTask};

        (async (taskContainer) => {
            await axios.post(route, request).then( () => {
                $(taskContainer).animate({left: '250px', opacity: 0,}, 600, function() {
                    $(this).remove();
                    checkTasksExist(this, '.tests-container');
                });

                //for statistics
                let statics = {key: 'user_statistics', value: {}};
                statics.value[date] = {
                    id: idTask,
                };
                axios.post(route, statics).then( () => {
                }).catch( ( error ) => {
                    console.log( error );
                });

            }).catch( ( error ) => {
                console.log( error );
            })
        })(taskContainer);

    } else {
        alert ('Неверно!');
        var timer;

        // cancel previous timeout
        clearTimeout(timer);
        var self = $(taskContainer).find('.otvet-kod');
        // set new border collor. Or add new class for CSS integration
        self.css('border', '1px solid red');

        timer = setTimeout(function() {
            // reset CSS
            self.css('border-color', '');
        }, 5000); // time in miliseconds, so 5s = 5000ms
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
$('.otvet-kod').keypress(function(event){
    let keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        event.preventDefault();
        var answer = $(this).data('answer');
        proverka(event, answer);
    }
});
$('.steps').click(function (event) {
    let id = $(this).data('id');
    tips(event,id);
});


function checkTasksExist(elem, parentConatiner) {
    if ($("."+$(elem).attr('class')).length === 0 ) {
        $(parentConatiner).html('<div class="text-dark"><h4>Поздравляем!</h4> <h5>Вы перешли на новый уровень!</h5></div>');
        (async () => {
            await axios.post('level-up', '').then( () => {
                setTimeout(function () {
                    window.location.href = "dashboard";
                }, 5000);
            }).catch( ( error ) => {
                console.log( error );
            })
        })();
    }
}

if($('#tasks').length !== 0 ) checkTasksExist('.task', '.tests-container');



