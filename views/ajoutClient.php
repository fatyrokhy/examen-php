<h1 class="text-center text-2xl font-semibold">Ajouter un client</h1>
<form method="post" action="" >
    <div class="grid grid-cols-3 gap-4 flex items-center">
    <input type="hidden" name="controller" value="clientController">
    <input type="hidden" name="page" value="ajoutClient">

    <div class="mb-4">
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="tel"
            class="rounded-md border-2 border-gray-400 w-[50%] h-8" required>
    </div>

    <div class="mb-4">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom"
            class="rounded-md border-2 border-gray-400 w-[50%] h-8" required>
    </div>

    <div class="mb-4">
        <label for="adresse">Adresse :</label>
        <input id="adresse" name="adresse"
            class="rounded-md border-2 border-gray-400 w-[50%] h-8">
    </div>
    </div>

<div class=" border-2 border-gray-400 grid grid-cols-1 gap-4 p-4 rounded-md">
    <form action="" method="get">
        <input type="hidden" name="controller" value="clientController">
        <input type="hidden" name="page" value="ajoutClient">
        <input type="hidden" name="search_numero" value="<?= isset($_GET['search_numero']) ? ($_GET['search_numero']) : '' ?>">
        <div class="grid grid-cols-[35%_auto] gap-4">
            <div class="flex flex-nowrap gap-4 items-center">
                <label for="ref">Article:</label>
                <input type="text" name="search_produit" value="<?= $_SESSION['article']['libelle'] ?? '' ?>" class="rounded-md border-2 border-slate-100 w-[50%] h-8" placeholder="Entrez le nom du produit">
                <button type="submit" name="searchbtn2" class="rounded-md bg-blue-400 p-1 text-white">OK</button>
                <!-- <div class="text-red-400"><?= $errors["article"] ?? "" ?></div> -->
            </div>
    </form>
    <?php if (isset($_SESSION["article"]) && $_SESSION["article"] != null): ?>
        <form action="" method="post" class="">
            <input type="hidden" name="controller" value="clientController">
            <input type="hidden" name="page" value="ajoutClient">
            <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">
            <input type="hidden" name="article" value="<?= $_SESSION['article']['libelle'] ?? '' ?>">
            <div class="flex justify-between gap-1">
                <div class="flex flex-wrap gap-4">
                    <label for="ref">Prix:</label>
                    <input type="text" value="<?= $_SESSION["article"]['prix'] ?? '' ?>" name="prix" class="rounded-md border-2 border-gray-400 w-[50%] h-8" readonly>
                    <div class="text-red-400"><?= $errors["prix"] ?? "" ?></div>
                </div>
                <div class="flex flex-wrap gap-4">
                    <label for="ref">Quantité en stock:</label>
                    <input type="text" value="<?= $_SESSION["article"]['quantite_stock'] ?? '' ?>" name="quantite" class="rounded-md border-2 border-gray-400 w-[50%] h-8" readonly>
                    <div class="text-red-400"><?= $errors["quantite"] ?? "" ?></div>
                </div>
            </div>
        <?php endif; ?>

</div>
<div class="flex justify-between gap-4">
    <div class="flex gap-2">
        <div class="flex flex-wrap gap-4">
            <label for="ref">Quantité:</label>
            <input type="text" value="<?= $edit['quantite'] ?? '' ?>" name="quantite" class="rounded-md border-2 border-gray-400 w-[50%] h-8">
            <div class="text-red-400"><?= $errors["quantite"] ?? "" ?></div>
        </div>
        <button type="submit" name="btnAdd" class="rounded-md bg-blue-400 px-5 py-1 text-white">Ajouter</button>
    </div>
</div>
</form>
<div class="text-red-400"><?= $errors['msge'] ?? '' ?></div>
<div class="flex-grow">
    <table class="table-auto border-2 border-gray-400 rounded-lg w-full">
        <thead>
            <tr class="text-center bg-gray-200">
                <th>Articles</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($_SESSION['commandes']) > 0) : ?>
                <?php foreach ($_SESSION['commandes'] as $commande):
                ?>
                    <tr class="text-center border-b-2 border-slate-200 p-2">
                        <td><?= htmlspecialchars($commande['libelle']) ?></td>
                        <td><?= htmlspecialchars($commande['prix']) ?></td>
                        <td><?= htmlspecialchars($commande['quantite']) ?></td>
                        <td><?= htmlspecialchars($commande['quantite']) * htmlspecialchars($commande['prix']) ?></td>
                        <td class="   gap-4">
                            <a href="?controller=controllerCommande&page=formCommande&edit=<?= $index ?>&search_numero=<?= $_SESSION['client'][0]['tel'] ?>" class="text-blue-500"><i class="ri-edit-circle-line"></i></a>
                            <a href="?controller=controllerCommande&page=formCommande&index=<?= $index ?>&search_numero=<?= $_SESSION['client'][0]['tel'] ?>" class="text-red-500"><i class="ri-delete-bin-6-line"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Faites une dette.</p>
            <?php endif ?>
        </tbody>
    </table>
</div>
<span class="text-red-400"><?= $errors["msge1"] ?? '' ?></span>
<div class="flex justify-between">
<button type="submit" name="addClient" class="rounded-md bg-blue-400 p-1 text-white">Ajouter le client</button>
<div>Total: <span class="text-red-400">F CFA</span></div>
</div>
</div>
</form>

</div>



<!-- <form method="post" action="ajouter_dette.php">
    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
    
    <label for="montant">Montant :</label>
    <input type="number" id="montant" name="montant"
     class="rounded-md border-2 border-gray-400 w-[50%] h-8"  step="0.01" required>
    
    <label for="date">Date :</label>
    <input type="date" id="date" name="date"
     class="rounded-md border-2 border-gray-400 w-[50%] h-8"  required>
    
    <label for="etat">État :</label>
    <select id="etat" name="etat"
     class="rounded-md border-2 border-gray-400 w-[50%] h-8"  required>
        <option value="Solde">Soldé</option>
        <option value="Restant">Restant</option>
    </select>
    
    <h3>Articles</h3>
    <?php
    // Supposons que $articles contient la liste des articles disponibles
    foreach ($articles as $article) {
        echo "<div>";
        echo "<input type='checkbox' name='articles[{$article['id']}]' id='article_{$article['id']}'>";
        echo "<label for='article_{$article['id']}'>{$article['libelle']} (Stock : {$article['quantite_en_stock']})</label>";
        echo "<label for='quantite_{$article['id']}'>Quantité :</label>";
        echo "<input type='number' name='quantites[{$article['id']}]' id='quantite_{$article['id']}' min='1' max='{$article['quantite_en_stock']}'>";
        echo "</div>";
    }
    ?>
    
    <button type="submit">Ajouter la dette</button>
</form> -->