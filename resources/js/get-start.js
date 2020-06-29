const axios = require('axios');
import modalAlert from "./modalAlert";

let resolvedTask = 0;
var id_inte;
function proverka (e, val) {

    let taskContainer = e.target.closest('.task');
    let answer = e.target.closest('div').querySelector('.otvet-kod').value;
    let checkAnswer = (val,compVal) => String(val)
        .replace(/\s/g, '')
        .split(':')
        .find(x => x === compVal.replace(/\s/g, ''));

    let date = $('[name="date"]').val();

    if (checkAnswer(val,answer)) {
        resolvedTask++;
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
                    taskLeft();
                    const {resolved, rows} = $('#totalPercent').data('json');
                    let result = ((resolved+resolvedTask) / rows) * 100;
                    $('#totalPercent').html(Math.round((result + + Number.EPSILON) * 10) / 10);
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
        modalAlert('Неверно!', timerHandler);
        var timer;


        // cancel previous timeout
        clearTimeout(timer);
        var self = $(taskContainer).find('.otvet-kod');

        function timerHandler() {
            // set new border collor. Or add new class for CSS integration
            self.css('border', '1px solid red');
            timer = setTimeout(function() {
                // reset CSS
              //  self.css('border-color', '');
            }, 5000); // time in miliseconds, so 5s = 5000ms
        }
    }
};

function tips(event, id) {
    let elem = event.target;
    event.preventDefault();

    if(id_inte) {
        alert ('У вас включен счетчик для другой задачи');
        return false;
    }



    let tag = event.target.closest('.task').querySelector('[class*="hints-"][style="display:none;"]');
    if(tag) {
        tag.style.display = 'block';
    }

    let hintBloks = event.target.closest('.task').querySelectorAll('[class*="hints-"][style="display:none;"]');

    console.log(hintBloks);
    if(hintBloks.length === 0) {
        $(elem).remove();
        return;
    }

    elem.style.display = 'none';
    $('.steps').attr('disabled', true).addClass('btn-dark');
    window.localStorage.setItem('timer', JSON.stringify({id: id}));
    var timer = event.target.parentNode.parentNode.querySelector('.timer');

    function timerFunc () {
        var totalSec = 200;
        id_inte = setInterval(function () {

            if(totalSec == 1) {
                clearInterval(id_inte);
                id_inte = null;
                elem.style.display = null;
                timer.innerHTML = null;
                $('.steps').attr('disabled', false).removeClass('btn-dark');
                if(hintBloks.length === 0) $('.steps').remove();
                window.localStorage.removeItem('timer');
                return;
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

let timer = window.localStorage.getItem('timer');
if(timer) {
    let {id} = JSON.parse(timer);
}

const taskLeft = () => {
    $('#taskLeft').html($('.task').length);
};

taskLeft();