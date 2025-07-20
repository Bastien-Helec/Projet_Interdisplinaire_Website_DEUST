<?php

class Send {
    private string $id_form;
    private string $path;
    private ?string $resultpath;

    public function __construct(string $id_form, string $path,?string $resultpath = null) {
        $this->id_form = $id_form;
        $this->path = $path;
        $this->resultpath = $resultpath;
    }

    public function Send(){
        echo "
        document.addEventListener('DOMContentLoaded', function() {
        let clickedButton = null;
        document.querySelectorAll('#{$this->id_form} button[type=\"submit\"]').forEach(function (button) {
        button.addEventListener('click', function () {
            clickedButton = this;
        });
    });
            if (document.getElementById('{$this->id_form}') && document.getElementById('{$this->id_form}').tagName === 'FORM') {
                document.getElementById('{$this->id_form}').addEventListener('submit', function(event) {
                    event.preventDefault();
                    var Form_Data = new FormData(this);
                    if (clickedButton) {
                        Form_Data.append('btn_value_envoi', clickedButton.value);
                    }
                    let data = {};
                    var requete = new XMLHttpRequest();
                    requete.open('POST', '{$this->path}', true);
                    requete.onload = function() {
                        if (requete.status === 200) {
                            console.log(requete);
                            var response = JSON.parse(requete.responseText);
                            console.log(response);
                            const banner = document.getElementById(response['banner']['id']);
                            banner.textContent = response['banner']['message'];
                            banner.classList.add('actif');
                            if (response.Status === 'Success') {
                            setTimeout(()=> {
                                window.location.href = '{$this->resultpath}';
                                banner.classList.remove('actif');
                                }, 2000);
                            }else{
                            setTimeout(()=> {
                                banner.classList.remove('actif');
                                }, 2000);
                            }
                        } else {
                            console.error('Erreur de la requête : ' + requete.status + ' ' + requete.responseText);
                        }
                    };
                    requete.send(Form_Data);
                });
            } else {
                console.error('Erreur: L\'élément avec l\'id {$this->id_form} n\'existe pas ou n\'est pas un formulaire.');
            }
        });
        ";
    }

}


?>