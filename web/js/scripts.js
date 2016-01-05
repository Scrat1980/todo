$(function() { 
    // Рисование - оформление
   

    // При клике на пункт тогглим его тело, шапку оставляем.
    // Не скрываем тело при редактировании.
    $('div.item').parent().css('cursor', 'pointer');

    $('.container').on('click', function(e) {
        if (!$(e.target).is('textarea')){
            if ($(e.target).is('.panel-heading')) {
                $(e.target).next().slideToggle(); 
            } else if($(e.target).is('.panel-body')){
                $(e.target).slideToggle();
            } else if($(e.target).parent().is('.panel-body')){
                $(e.target).parent().slideToggle();
            }
        }
    }); 
      
    // Тогглим табы "список" - "новый айтем" 
    $('#tabs li').on('click', function() { 
        $('#tabs li').removeClass('active'); 
  
        $(this).addClass('active'); 
          
        if($(this).attr('id') == 'newitem_tab') { 
            $('#todo').css('display', 'none'); 
            $('#addNewEntry').css('display', 'block');           
        } else { 
            $('#addNewEntry').css('display', 'none'); 
            $('#todo').css('display', 'block'); 
        } 
        return false; 
    });



    // Функции


    // Отрисовка пункта списка
    function drawItem(title, description, id){
        return '<div class="panel panel-primary"><div class="panel-heading">' + title + '</div><div class="item panel-body" style="position:relative"><p>' + description + '</p><input type="hidden" name="id" id="id" value="' + id + '" /><div class = "options btn-group" style="position: absolute; right: 5px; top: -38px;"><a class="editEntry btn btn-default" href="#"><span class="glyphicon glyphicon-edit"></span></a><a class="deleteEntryAnchor btn btn-default" href="#"><span class="glyphicon glyphicon-remove"></span></a></div></div></div>';
    }

    // Инициализируем
    $.ajax({ 
        type: 'GET', 
        url: 'index.php?action=init',
        success: function(todos){
            var arrTodos = window.JSON.parse(todos);

            arrTodos.forEach(function(element, index, array)
            {
                nextItem = drawItem(element['title'], element['description'], element['id'])
                
                $('#todo').append(nextItem);
                $('#todo:first-child div.item').next().css('dispay', 'none');
                // Скрыть описание предыдущего
                $('#todo div.item:eq(1)').css('display', 'none');
                $('div.item').parent().css('cursor', 'pointer');
                    
            })
        } 
    });


    // Удаляем пункт списка 
    $('.container').on('click', function(e) { 
        var thisparam;

        if($(e.target).is('a.deleteEntryAnchor')){
            thisparam = $(e.target);
        } else if($(e.target).parent().is('a.deleteEntryAnchor')) {
            thisparam = $(e.target).parent();
        }

        if(thisparam){
            var delId = thisparam.parent().parent().children('input').val();

            $.ajax({ 
                type: 'GET', 
                url: 'index.php?action=delete',
                data: 'id=' + delId,
                success: function(results){
                    thisparam.parent().parent().parent().fadeOut('slow');
                    thisparam.parent().parent().parent().remove();
                    $('#todo div:first div.panel-body').css('display', 'block');
                } 
            })
            return false; 
        }
    });

    // Добавляем пункт в список
    $('#add').on('submit', function (e) {
        e.preventDefault();
        var title = $('#title').val();
        var description = $('#description').val();

        $.ajax({
            type: 'post',
            url: 'index.php?action=addItem',
            data: $('form').serialize(),
            success: function (id) {
                // Очистить форму
                $('#title').val('');
                $('#description').val('');

                // Вернуться на начальный таб
                $('#todo_tab').trigger('click');

                // Добавить данные в список
                nextItem = drawItem(title, description, id);
                
                $('#todo').prepend(nextItem);
                $('#todo:first-child div.item').next().css('dispay', 'none');
                // Скрыть описание предыдущего
                $('#todo div.item:eq(1)').css('display', 'none');
                $('div.item').parent().css('cursor', 'pointer');
            }
        });
    }); 
      
    // Редактируем пункт списка 
    $('.container').on('click', function(e) { 
        var thisparam;

        if($(e.target).is('a.editEntry')){
            thisparam = $(e.target);
        } else if($(e.target).parent().is('a.editEntry')) {
            thisparam = $(e.target).parent();
        }

        if(thisparam){

            var oldText = thisparam.parent().parent().find('p').text();
            var id = thisparam.parent().parent().children('input').val(); 
            thisparam.parent().parent().find('p').empty().append('<textarea class="newDescription" cols="23">' + oldText + '</textarea>'); 
            
            $('.newDescription').blur(function() { 
                var newText = $(this).val();

                $.ajax({ 
                    type: 'POST', 
                    url: 'index.php?action=updateEntry', 
                    data: 'description=' + newText + '&id=' + id, 
                      
                    success: function(results) { 
                        thisparam.parent().parent().find('p').empty().append(newText); 
                        } 
                    }); 
            }); 
            return false;
        }

    });
  
});