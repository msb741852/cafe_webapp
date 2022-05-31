const table = document.getElementById('menuChoice');
const content = document.getElementsByClassName('content');
const tabMenu = document.getElementsByClassName('tabBtn'); 


function menuChoice(i) {
    let menuContent = document.getElementById('tab0'+i);
    let tab = document.getElementById('btn'+i);

    for(let i=0; i < content.length; i++) {
        content[i].style.display = "none";
        tabMenu[i].className="tabBtn";
    }
    
    tab.classList.add("clicked");
    menuContent.style.display="flex";
}

function menuAdd(menuName, price) {
    
    let checkNum = '';
    let idx = 0;
    // 추가하려는 메뉴가 있는지 확인
    for (let i = 0; i < table.rows.length; i++) {
        let checkName = document.querySelector('#menuName'+i).value;
        
        if(checkName === menuName) {
            checkNum = i;
        }
    }
    // check가 yes라면 갯수만 증가
    if(checkNum !== '') {
        let menuNum = parseInt(document.querySelector('#number'+checkNum).value) + 1;
        document.querySelector('#number'+checkNum).value = menuNum;
        drink(plus);
    } else {
        // 테이블에 새로운 행 추가
        const newRow = table.insertRow();
        
        // 새로운 행에 cell 추가
        const newCell0 = newRow.insertCell(0);
        const newCell1 = newRow.insertCell(1);
        const newCell2 = newRow.insertCell(2);
        const newCell3 = newRow.insertCell(3);
        const newCell4 = newRow.insertCell(4);

        for (let i = 0; i < table.rows.length; i++) {
            if(idx === parseInt(table.rows[i].cells[0].innerText)) {
                idx += 1;
            }
        }


        newCell0.innerText = idx;
        newCell1.innerHTML = "<input type='text' name='menuName[]' id='menuName"+idx+"'value='"+menuName+"' readonly>";
        newCell2.innerHTML = "<input type='text' name='number[]' id='number"+idx+"' value='1' readonly>";
        newCell3.innerText = price;
        newCell4.innerHTML = "<button type='button' class='plusBtn' onclick='plus("+idx+")';>+</button><button type='button' class='minusBtn' onclick='minus("+idx+")'>-</button>";
    


        newCell1.className = 'menuName';
        newCell2.className = 'number';
        newCell3.className = 'price';
        newCell4.className = 'pmBtn';

        newCell1.setAttribute("name", "menuName[]");
        newCell2.setAttribute("name", "number[]");
        newCell3.setAttribute("name", "price[]");

        drink(plus);
    }

    sum();
}

function sum() {
    let sum = 0;
    for(let i=0; i < table.rows.length; i++) {
        sum += parseInt(document.querySelector('#number'+i).value) * parseInt(table.rows[i].cells[3].innerText);
    }

    // 합계 출력
    document.querySelector('#sum_all').innerText = "결제금액 : " +sum+ "원";
}


function plus(checkNum) {
    
    let number = parseInt(document.querySelector('#number'+checkNum).value);
    number = number + 1;
    document.querySelector('#number'+checkNum).value = number;
    
    drink(plus);
    sum();
}

function minus(checkNum) {
    let number = parseInt(document.querySelector('#number'+checkNum).value);
    
    number = number - 1;
    if (number < 0) {
        number = 0;
    } else {
        drink(minus);
    }
    document.querySelector('#number'+checkNum).value = number;

    sum();
}


function nameCheck() {
    $.ajax({
        url: "pos_phoneCheck.php",
        type: "get",
        data: {
            firstNum: $('#firstNum').val(),
            secondNum: $('#secondNum').val(),
            thirdNum: $('#thirdNum').val()
        }
    }).done(function(result) {
        $('#inputNum').text(result);
    });

    phone_sum();
}


function drink(how) {
    
let drink_sum = parseInt(document.querySelector('#drink_sum').value);
    switch(how) {
        case plus :
            drink_sum = drink_sum +1;
            document.querySelector('#drink_sum').value = drink_sum;
            break;
        case minus :
            drink_sum = drink_sum -1;
            document.querySelector('#drink_sum').value = drink_sum;
            
            if(drink_sum < 0) {
                document.querySelector('#drink_sum').value = 0;
            }
            break;
    }
}

function phone_sum() {
    let secondNum = document.querySelector('#secondNum').value;
    let thirdNum = document.querySelector('#thirdNum').value;
    let phone = '010' + '-' + secondNum + '-' + thirdNum;
    
    document.querySelector('#phoneNum').value = phone;
}

function menuCheck() {
    let check = document.querySelector('#sum_all').innerText;
    if(check === '결제금액 : 0원') {
        alert ('메뉴를 선택하세요.');
    } else {
        let form = document.menuForm;
        form.submit();
    }
}