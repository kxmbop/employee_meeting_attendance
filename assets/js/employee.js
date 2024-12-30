function display_control(id_name, action){
    document.getElementById(id_name).style.display=action;
}

function clear_fields(id_names, modal_id) {
    display_control(modal_id,"none");
    for (let i = 0; i < id_names.length; i++) {
        document.getElementById(id_names[i]).value=null;
    }
}

function fill_fields_v2(fields,modal_id) {
    display_control(modal_id,"block");
    let idname = Object.keys(fields);
    let flds = Object.values(fields);

    for (let i = 0; i < idname.length; i++) {
        document.getElementById(idname[i]).value=flds[i];
    }
}

function fill_fields_v3(fields,modal_id) {
    display_control(modal_id,"block");
    document.getElementById("mtgcode").value=fields[0];
    document.getElementById("agenda_name").innerHTML=fields[1];
}

function delete_something(num, management) {
    let ok = confirm("Do you want to delete the "+management);
    if (ok) {
        location.href = "./actions/"+management+".php?delete_"+management+"="+num;
    }
}
