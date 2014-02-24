function borrarPackList($packageid){
    if(confirm('¿Estas seguro?'))
            location.href = ROOT+'/users/delete/'+$packageid;
}