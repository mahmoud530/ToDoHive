var add_task = document.getElementById("add_task")


function openaddtask() {

    add_task.classList.remove("v-none")
    // add_task.classList.add("open_add_task")
}


function closeaddtask() {
    add_task.classList.add("v-none")
}


var add_member = document.getElementById("add_member")
function openaddmember() {
    add_member.classList.remove("v-none")
}
function closeaddmember() {
    add_member.classList.add("v-none")
}

var list = document.getElementById("list")

function openList() {
    list.classList.toggle("d-none")
}
function closeList() {
    list.classList.add("d-none")
}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    const input = document.getElementById("myInput");
    const filter = input.value.toUpperCase();
    const div = document.getElementById("myDropdown");
    const a = div.getElementsByTagName("a");
    for (let i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}