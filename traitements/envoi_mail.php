<?php

session_start();
$_SESSION['information'] = '';

// Vérification de l'appel via le formulaire
if (count($_POST) == 0) {
    // Si le le tableau est vide, on affiche le formulaire
    header('location: ../contact.php');
} else {

    $affichage_retour = '';    // Lignes à ajouter au début des vérifications
    $erreurs = 0;

    // Vérification des données du formulaire
    // Exemple pour le nom
    if (!empty($_POST['nom'])) {
        $nom = $_POST['nom'];
    } else {
        $affichage_retour .= 'Le champ NOM est obligatoire<br>';
        $erreurs++;
        //header('location: ../contact.php');
    }

    if (!empty($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
    } else {
        $affichage_retour .= 'Le champ PRENOM est obligatoire<br>';
        $erreurs++;
        //header('location: ../contact.php');
    }

    if (!empty($_POST['message'])) {
        $message = $_POST['message'];
    } else {
        $affichage_retour .= 'Le champ MESSAGE est obligatoire<br>';
        $erreurs++;
        //header('location: ../contact.php');
    }

    if (!empty($_POST['radio'])) {
        $type_demande = $_POST['radio'];
    } else {
        $affichage_retour .= 'Le champ de sélection est obligatoire<br>';
        $erreurs++;
    }

    if (!empty($_POST['email'])) {
        // Si le champ email contient des données
        // Verification du format de l'email
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        } else {
            // Si l'email est incorrect on retourne au formulaire
            $affichage_retour .= 'Adresse mail incorrecte<br>';
            $erreurs++;
            //header('location: ../contact.php');
        }
        // Si le champ email est vide, on retourne au formulaire
    } else {
        $affichage_retour .= 'Le champ EMAIL est obligatoire<br>';
        $erreurs++;
        //header('location: ../contact.php');
    }

    if ($erreurs == 0) {
        // Préparation des données
        // Récupération des données du formulaire

        $prenom = ucfirst($prenom);
        $nom = ucfirst($nom);

        if ($type_demande === 'Information') {
            $subject = 'SAE105 : demande d\'information de ' . $prenom . ' ' . $nom;
            $subject2 = 'SAE105 : Confirmation de votre demande d\'information';
            $contenu_email = "
        <html>
        <head>
        <style>
            body {
                background-color: #000;
                padding: 20px;
                font-family: 'Albert Sans', sans-serif;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #000;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #f9ad0e;
            }
            p {
                margin-bottom: 10px;
                color: #fff;
            }
        </style>
        </head>
        <body>
        <div class='container'>
            <h1>Demande d'information</h1>
            <p>Bonjour <strong>$prenom $nom</strong>,</p>
            <p>Nous avons bien pris en compte votre demande d'information.</p>
            <p>Votre message :</p>
            <p>$message</p>
            <p>Cordialement,</p>
            <p>L'équipe de mmi23f03</p>
        </div>
        </body>
        </html>";
            $contenu_email_2 = "
        <html>
        <head>
        <style>
            body {
                background-color: #000;
                padding: 20px;
                font-family: 'Albert Sans', sans-serif;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #000;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #f9ad0e;
            }
            p {
                margin-bottom: 10px;
                color: #fff;
            }
        </style>
        </head>
        <body>
        <div class='container'>
            <h1>Confirmation de votre demande d'information</h1>
            <p>Bonjour <strong>$prenom $nom</strong>,</p>
            <p>Votre demande d'information a bien été prise en compte.</p>
            <p>Votre demande d'information :</p>
            <p>$message</p>
            <p>Cordialement,</p>
            <p>L'équipe de mmi23f03</p>
        </div>
        </body>
        </html>";
        } elseif ($type_demande === 'Reclamation') {
            $subject = 'SAE105 : réclamation de ' . $prenom . ' ' . $nom;
            $subject2 = 'SAE105 : Confirmation de votre demande de réclamation';
            $contenu_email = "
        <html>
        <head>
            <style>
                body {
                    background-color: #000;
                    padding: 20px;
                    font-family: 'Albert Sans', sans-serif;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #000;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #f9ad0e;
                }
                p {
                    margin-bottom: 10px;
                    color: #fff;
                }
            </style>
        </head>
        <body>
        <div class='container'>
            <h1>Demande de réclamation</h1>
            <p>Bonjour <strong>$prenom $nom</strong>,</p>
            <p>Votre réclamation sera traitée dans les meilleurs délais.</p>
            <p>Votre réclamation :</p>
            <p>$message</p>
            <p>Cordialement,</p>
            <p>L'équipe de mmi23f03</p>
        </div>
        </body>
        </html>";
            $contenu_email_2 = "
        <html>
        <head>
            <style>
                body {
                    background-color: #000;
                    padding: 20px;
                    font-family: 'Albert Sans', sans-serif;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #000;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #f9ad0e;
                }
                p {
                    margin-bottom: 10px;
                    color: #fff;
                }
            </style>
        </head>
        <body>
        <div class='container'>
            <h1>Confirmation de la demande de réclamation</h1>
            <p>Bonjour <strong>$prenom $nom</strong>,</p>
            <p>Votre demande de réclamation a bien été transmise et sera traitée dans les meilleurs délais.</p>
            <p>Votre réclamation :</p>
            <p>$message</p>
            <p>Cordialement,</p>
            <p>L'équipe de mmi23f03</p>
        </div>
        </body>
        </html>";
        } elseif ($type_demande === 'Devis') {
            $subject = 'SAE105 : demande de devis de ' . $prenom . ' ' . $nom;
            $subject2 = 'SAE105 : Confirmation de votre demande de devis';
            $contenu_email = "
        <html>
        <head>
            <style>
                body {
                    background-color: #000;
                    padding: 20px;
                    font-family: 'Albert Sans', sans-serif;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #000;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #f9ad0e;
                }
                p {
                    margin-bottom: 10px;
                    color: #fff;
                }
            </style>
        </head>
        <body>
        <div class='container'>
            <h1>Demande de devis</h1>
            <p>Bonjour <strong>$prenom $nom</strong>,</p>
            <p>Votre demande de devis a été transmise.</p>
            <p>Votre devis :</p>
            <p>$message</p>
            <p>Cordialement,</p>
            <p>L'équipe de mmi23f03</p>
        </div>
        </body>
        </html>";
            $contenu_email_2 = "
        <html>
        <head>
            <style>
                body {
                    background-color: #000;
                    padding: 20px;
                    font-family: 'Albert Sans', sans-serif;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #000;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #f9ad0e;
                }
                p {
                    margin-bottom: 10px;
                    color: #fff;
                }
            </style>
        </head>
        <body>
        <div class='container'>
            <h1>Confirmation de la demande de devis</h1>
            <p>Bonjour <strong>$prenom $nom</strong>,</p>
            <p>Votre demande de devis a été transmise.</p>
            <p>Votre devis :</p>
            <p>$message</p>
            <p>Cordialement,</p>
            <p>L'équipe de mmi23f03</p>
        </div>
        </body>
        </html>";
        }


        //MAIL DE CONTACT
        $headers['From'] = $email;                            // Pour pouvoir répondre à la demande de contact
        $headers['Reply-to'] = $email;                        // On donne l'adresse de l'utilisateur comme adresse de réponse
        $headers['X-Mailer'] = 'PHP/' . phpversion();            // On précise quel programme à généré le mail
        $headers['MIME-Version'] = '1.0';
        $headers['content-type'] = 'text/html; charset=utf-8';

        // On fixe l'adresse du destinataire - Pour ce Mail il s'agit de notre adresse MMI@mmi-troyes.fr
        $email_dest = "mmi23f03@mmi-troyes.fr";

        // Envoi de l'email avec le contenu approprié
        if (isset($contenu_email)) {
            if (mail($email_dest, $subject, $contenu_email, $headers)) {
                $erreurs = 0;
            } else {
                $erreurs++;
            }
        }

        // Préparation des données pour la confirmation
        //MAIL DE CONFIRMATION
        $headers2['From'] = $email_dest;                            // Pour pouvoir répondre à la demande de contact
        $headers2['Reply-to'] = $email_dest;                        // On donne l'adresse de l'utilisateur comme adresse de réponse
        $headers2['X-Mailer'] = 'PHP/' . phpversion();            // On précise quel programme à généré le mail
        $headers2['MIME-Version'] = '1.0';
        $headers2['content-type'] = 'text/html; charset=utf-8';

        //Envoi du mail de confirmation
        if (mail($email, $subject2, $contenu_email_2, $headers2)) {
            $erreurs = 0;
        } else {
            $erreurs++;
        }

        if ($erreurs != 0) {
            $affichage_retour = "Echec de l'envoi du message | $erreurs";
            echo $affichage_retour;
        } else {
            $affichage_retour = 'Votre demande a bien été envoyée';
            echo $affichage_retour;
        }
    }
    $_SESSION['information'] = $affichage_retour;
    header('location: ../contact.php');
}
?>