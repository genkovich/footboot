<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />

        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <title>Letter</title>
        <script>
            function copySel() {
                var sel_1 = document.getElementById("left_list");
                var sel_2 = document.getElementById("right_list");
                while (sel_1.options.length > 0)
                    sel_2.appendChild(sel_1.options[0]);

            }
            function copyDown() {
                var sel_1 = document.getElementById("left_list");
                var sel_2 = document.getElementById("right_list");
                while (sel_2.options.length > 0)
                    sel_1.appendChild(sel_2.options[0]);

            }
            function move(dir1, dir2) {
                var select = document.getElementById(dir2 + '_list');

                document.getElementById(dir1 + '_list').appendChild(select.options[select.selectedIndex]);
            }

            function sendMessage() {
                var selEl = document.getElementById("right_list");
                for (i = 0; i < selEl.length; i++) {
                    selEl.options[i].selected = true;
                }

                var subj = $('#subj').val();
                var message = $('#mess').val();

                var options = $('#right_list').val();
                var url = "/index.php/admin/lunit/sendmess/";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: 'subj=' + subj + "&mess=" + message + "&opt=" + options,
                    beforeSend: function () {
                        $('#results').html("<img src='/css/images/loader.GIF' />");
                    },
                    success: function (data) {
                        $('#results').html(data);
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText + '|\n' + status + '|\n' + error);
                    }

                });
            }
			
			function deleteMail() {
                var delMail = $('#delete_mail').val();
                var сonfirm = confirm("Вы уверены что хотите удалить email?");
                if (сonfirm == true) {
                    var url = "/index.php/admin/lunit/delMail/";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'mail=' + delMail,
                        beforeSend: function () {
                            $('#results').html("<img src='/css/images/loader.GIF' />");
                        },
                        success: function (data) {
                            location.reload();
                            $('#results').html(data+' удалён из базы адресов');
                        },
                        error: function (xhr, status, error) {
                            alert(xhr.responseText + '|\n' + status + '|\n' + error);
                        }
                    });
                }
            }
        </script>
    </head>
    <body><div class="messagel">
            <div>  <input type="text" placeholder="Тема" id="subj"/> </div>
            <div>  <textarea cols="50" rows="10" placeholder="Введите текст" id="mess"></textarea> </div>
        </div>
        <div id="contentList">

            <div>
                <select  id="left_list" multiple size="10" style="width: 150px;">
                    <?php
                    foreach ($email as $opt) {
                        echo '<option value="' . $opt . '">' . $opt . '</option>';
                    }
                    ?>

                </select>
            </div>
            <div id="buttonsList">
                <button onclick="copySel()"> >>> </button><br/>
                <button onclick="move('right', 'left')"> > </button><br/>

                <button onclick="move('left', 'right')"> < </button><br/>
                <button onclick="copyDown()"> <<< </button>

            </div>
            <div>
                <select  id="right_list" multiple size="10" style="width: 150px;"></select>
            </div>
            <div class="sendMess"><button onclick="sendMessage()">Send</button><br/></div>
			
        </div>
        <div id="results"></div>
		<div class="cl"></div>
		<div class="delMail">
			<h2>Удаление адреса из базы</h2>
			<select id="delete_mail">
				<?php
				foreach ($email as $opt) {
				   echo '<option value="' . $opt . '">' . $opt . '</option>';
				}
				?>
			</select>
			<button onclick="deleteMail()">Удалить</button>
		</div>
		<br><br>
		<div class="delMail">
			<a href="/admin">Вернуться на главную страницу админки</a>
		</div>
    </body>
</html>
