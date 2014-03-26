<div id="sectionHeader">
    <h1>Donantes</h1>
    <div id="sectionNav">
        <div class="btn grey" onclick="location.href = '<?=URL; ?>donantes/lista/1'">Donante</div>
        <div class="btn grey" onclick="location.href = '<?=URL; ?>donantes/lista/2'">Empresa</div>
        <div class="btn grey" onclick="location.href = '<?=URL; ?>donantes/lista/3'">ONG</div>
        <div class="btn blue" onclick="location.href = '<?=URL; ?>donantes/view'">Nuevo colaborador</div>
    
    </div>
    <div class="clr"></div>
</div>
<div id="sectionContent">
<? $this->getView('table');?>
</div>