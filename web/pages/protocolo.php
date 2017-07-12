
<?php
if (isset($_GET['q'])) {
    ?>
    <div class="alert alert-warning"
         style="width: 40%;
         padding: 5% 9%;
         margin: 2% auto">
        
        <strong>Atenção!</strong> Protocolo não encontrado!<br>
        <p>Verifique se o número está correto</p><br>
        
            <a href="/?p=protocolo.php" style="margin-top: 10%;margin-left: 25%;">Retornar</a>
        
    </div>

<?php } else { ?>

    <div class="panel panel-default" style="margin: 0.4% 7.9%;padding:5%;">
        <div class="panel-body">

            <form class="form-inline">
                <div class="form-group" style="width: 30%;margin-right: 3%;">
                    <input type="text" class="form-control" id="busca-protocolo" 
                           placeholder="Número do protocolo"
                           style="width: 100%">
                </div>
                <a href="#" onclick="this.href = 'protocolo/busca?codigo_busca=' + document.getElementById('busca-protocolo').value" 
                   accesskey=""class="btn btn-default"
                   target="_blank">
                    Consultar Protocolo
                </a>

            </form>
        </div>
    </div>
<?php }
?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>