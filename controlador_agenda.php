<?php


        function json(){

            //pegar arquivo json
            $contatosAuxiliar = file_get_contents('contatos.json');
            //decodificar arquivo json para array
            $contatosAuxiliar = json_decode($contatosAuxiliar, true);

            return $contatosAuxiliar;
        }

        function cadastrar($nome, $email, $telefone){

            $contatosAuxiliar2 = json();

            $contato = [
                'id' => uniqid(),
                'nome' => $nome,
                'email' => $email,
                'telefone' => $telefone
            ];

            array_push($contatosAuxiliar2, $contato);

            $contatosJson = json_encode($contatosAuxiliar2, JSON_PRETTY_PRINT);

            file_put_contents('contatos.json', $contatosJson);

            header("Location: index.phtml");
        }


        function buscarContato($nome){

            $contatosAuxiliar2=json();

            $contatosBusca = [];

            foreach($contatosAuxiliar2 as $contato);
            if ($contato[$nome] == $nome){
                $contatosBusca = $contato;
            }
                return $contatosBusca;
        }

        function excluirContato($id){


            $contatosAuxiliar2 = json();

            //percorrer array para procurar id e excluir
            foreach ($contatosAuxiliar2 as $posicao => $contato) {
                if ($id == $contato['id']) {
                    unset($contatosAuxiliar2[$posicao]);
                }
            }
            //transforma array em Json
            $contatosJson = json_encode($contatosAuxiliar2, JSON_PRETTY_PRINT);
            //Manda o array pro arquivo Json
            file_put_contents('contatos.json', $contatosJson);

            //Direciona pro index
            header('Location: index.phtml');
        }


        function buscarContatoEditar($idBuscado){

            $contatosAuxiliar2 = json();

            foreach ($contatosAuxiliar2 as $contato) {
                if ($contato['id'] == $idBuscado) {
                    return $contato;
                }
            }
        }

        function salvarContatoEditado($id, $nome, $email, $telefone){

            $contatosAuxiliar2 = json();

            //percorre o array e verifica se tem id igual, se tiver ele salva as informações editadas
            foreach ($contatosAuxiliar2 as $posicao => $contato) {
                if ($contato['id'] == $id) {

                    $contatosAuxiliar2[$posicao]['nome'] = $nome;
                    $contatosAuxiliar2[$posicao]['email'] = $email;
                    $contatosAuxiliar2[$posicao]['telefone'] = $telefone;

                    break;
                }
            }

            $contatosJson = json_encode($contatosAuxiliar2, JSON_PRETTY_PRINT);
            file_put_contents('contatos.json', $contatosJson);

            header('Location: index.phtml');

        }

        //ROTAS
        if ($_GET['acao'] == 'cadastrar') {
            cadastrar('leo', 'leo@leo.c  om', '12345678');
        } elseif ($_GET['acao'] == 'excluir') {
            excluirContato('598467f7827da');
        } elseif ($_GET['acao'] == 'editar') {
            salvarContatoEditado('598467f7827da', 'leonardo', 'leo@mail.com','87654321');
        }