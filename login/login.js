function adminCheck() {
    if($('#id').val() === '') {
        alert("ID를 입력해주세요");
    } else if ($('#pw').val() === '') {
        alert("비밀번호를 입력해주세요");
    } else if($('#id').val() !== '' && $('#pw').val() !== '') {
        $.ajax({
            url: "adminCheck.php",
            type: "POST",
            data: {
                id : $('#id').val(),
                pw : $('#pw').val()
            }
        }).done(function(data) {
            alert(data);
            if(data === "로그인 성공!") {
                window.location.href='../pos/pos.php';
            }
        });
    }
}
