<div class="tittle-character">
  <h2>Personnages</h2>  
</div>

<div class="btn-character">
    <a href="./?page=character_add">Créer un personnage</a>
    <a href="./?page=character_update">Editer un personnage</a>
</div>

<div class="container-card-character">
    <?php foreach ($params["character"] as $key => $character) { ?>
        <div class="card-character">
        <a href="./?page=character_show&character_id=<?= $character->getId();?>">
            <img src="/Romain/public/assets/image/upload/<?php echo htmlspecialchars($character->getFile_path_image()); ?>" alt="image télécharger pour le personnage">
        </a>
            <h3>Nom : <?php echo htmlspecialchars($character->getName());?></h3>
            <p>Description : <?php echo htmlspecialchars($character->getDescription());?></p>
            <p>Nationalitée : <?php echo htmlspecialchars($character->getNationality());?></p>
            <p>Difficulter : <?php echo htmlspecialchars($character->getDifficulty());?></p>
            <p>genre : <?php echo htmlspecialchars($character->getgender());?></p>
            <p>Arme : <?php echo htmlspecialchars($character->getWeapon());?></p>
            <p>Pouvoir : <?php echo htmlspecialchars($character->getPower());?></p>
            
            <div class="container-btn">
                <a href="./?page=character_show&character_id=<?php echo htmlspecialchars($character->getId());?>">
                    <button class="btn-list">VOIR</button>
                </a>
                <?php if (Service::checkIfUserIsConnected()) { ?>
                <?php if ($_SESSION['role'] == 'admin'){ ?>
					<button type="button"
							class="btn-delete js_article_button_deleted"
							onclick="dialog.showModal()"
							data-sheet_id="<?php echo $character->getId() ?>">
							Supprimer
					</button>
        	   	<a href="./?page=character_update&sheet_id=<?= $character->getId();?>">
                        <button type="button" class="btn-update-article">Modifier</button>
                </a>
               
                <?php } ?>
                
					<?php }  ?>
            </div>
    <?php } ?>
</div>
<?php include_once dirname(__DIR__) . "/character/template_part/_deleted_modal.php"; ?>