function confirmar_exclusao(nome, o_que, form){ //função início

  var confirmar = confirm("Você tem certeza que deseja excluir "+nome+" de "+o_que+"?"); //variável recebendo valor e a função de confirm, e concatenação do tipo e nome
    if(confirmar == true){ //se for verdadeiro
      document.getElementById(form).submit(); //exclui
    }else{ //se não for
      return false; //mantém
    }
}
