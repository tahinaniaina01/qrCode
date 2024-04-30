// Fonction anonyme pour gérer le préchargement des modules
(function () {
  // Vérifie si le navigateur supporte le préchargement des modules
  const relList = document.createElement("link").relList;
  if (relList && relList.supports && relList.supports("modulepreload")) return;

  // Précharge tous les modules déjà présents dans le document
  for (const linkElement of document.querySelectorAll(
    'link[rel="modulepreload"]'
  )) {
    preloadModule(linkElement);
  }

  // Observe les changements dans le document pour précharger les nouveaux modules
  new MutationObserver((mutations) => {
    for (const mutation of mutations) {
      if (mutation.type === "childList") {
        for (const node of mutation.addedNodes) {
          if (node.tagName === "LINK" && node.rel === "modulepreload") {
            preloadModule(node);
          }
        }
      }
    }
  }).observe(document, { childList: true, subtree: true });

  // Fonction pour précharger un module
  function preloadModule(element) {
    if (element.ep) return;
    element.ep = true;
    const options = getFetchOptions(element);
    fetch(element.href, options);
  }

  // Fonction pour obtenir les options de fetch pour un module
  function getFetchOptions(element) {
    const options = {};
    if (element.integrity) options.integrity = element.integrity;
    if (element.referrerPolicy) options.referrerPolicy = element.referrerPolicy;
    switch (element.crossOrigin) {
      case "use-credentials":
        options.credentials = "include";
        break;
      case "anonymous":
        options.credentials = "omit";
        break;
      default:
        options.credentials = "same-origin";
    }
    return options;
  }
})();

// Configuration du scanner QR Code
const serverUrl = "https://www.qrcode.com/index.php/Projet";
let role = "respo";
const qrCodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
qrCodeScanner.render(handleQrCodeScan);
document.querySelector("#reader").style.border = "none";

// Fonction pour gérer le scan du QR Code
async function handleQrCodeScan(qrCodeData) {
  let cleanedData = qrCodeData
    .split("")
    .filter((char) => /[a-zA-Z0-9:]/.test(char))
    .join("");
  console.log(cleanedData);
  qrCodeScanner.clear();
  showLoading(true);
  let response;
  try {
    if (isMacAddress(cleanedData)) {
      response = await sendRequest(`${serverUrl}/recupe_qrcode`, {
        mac: cleanedData,
      });
    } else if (isStudentId(cleanedData)) {
      response = await sendRequest(`${serverUrl}/recupe_qrcode`, {
        id: cleanedData,
      });
    } else {
      showInvalidQrCode();
      return;
    }
    console.log(response);
    if (role === "respo") {
      displayResponse(response);
    }
  } catch {
    response = {
      error: {
        message:
          "Une erreur s'est produite lors de l'envoi ou de la récupération des données",
      },
    };
    alert(response.error.message);
    reloadPage();
  }
  document.querySelector(".presence")?.addEventListener("click", (event) => {
    response = handlePresenceClick(event, cleanedData);
    event.currentTarget.innerHTML = response ? "OK" : "ERROR";
  });
  showLoading(false);
}

// Fonction pour envoyer une requête au serveur
async function sendRequest(url = "", data = {}) {
  return (
    await fetch(url, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    })
  ).json();
}

// Fonction pour afficher ou masquer le loader
function showLoading(isLoading) {
  const loadingElement = document.querySelector(".container-loading");
  loadingElement.style.display = isLoading ? "flex" : "none";
}

// Fonctions pour valider les données du QR Code
function isMacAddress(data) {
  return /^([0-9a-f]{2}:){5}[0-9a-f]{2}$/.test(data);
}

function isStudentId(data) {
  return /^[A-Z]+\d+20\d{2}20\d{2}$/.test(data);
}

// Fonction pour afficher un message d'erreur si le QR Code est invalide
function showInvalidQrCode() {
  const container = document.querySelector(".container");
  container.innerHTML = `
    <div class="presence-box">
      <div class="container-square">
        <span class="square1"></span>h
        <span class="square2"></span>
      </div>
      <h1>QRCODE INVALIDE</h1>
      <button class="presence">OK</button>
    </div>
  `;
}

// Fonction pour afficher la réponse du serveur
function displayResponse(response) {
  const container = document.querySelector(".container");
  const { nom, prenom, grade, statut, id } = response;
  if (statut === "impossible") {
    container.innerHTML = `
      <div class="presence-box">
        <div class="container-square">
          <span class="square1"></span>
          <span class="square2"></span>
        </div>
        <h1 class="invalide" style="background-color: #fff; text-align: center;">Vous ne pouvez plus faire de retrait aujourd'hui</h1>
        <button class="presence" style="margin-top: 50px;text-align: center" onclick="">OK</button>
      </div>
    `;
  } else {
    container.innerHTML = `
      <div class="presence-box">
        <div class="container-square">
          <span class="square1"></span>
          <span class="square2"></span>
        </div>
        <div class="container-image" style="background-image:url('https://www.qrcode.com/Images/${id}.jpg');"></div>
        <div class="container-information">
          <div class="container-info">
            <h3>Nom : ${nom}</h3>
            <h3>Prénom : ${prenom}</h3>
            <h3>Grade : ${grade}</h3>
          </div>
          <button class="presence">${statut || "Impossible"}</button>
        </div>
      </div>
    `;
  }
}

// Fonction pour gérer le clic sur le bouton de présence
async function handlePresenceClick(event, qrCodeData) {
  let response;
  const buttonText = event.currentTarget.innerText;
  if (buttonText === "Presence") {
    response = await sendRequest(`${serverUrl}/Presence`, {
      state: buttonText,
      id: qrCodeData,
    });
  } else if (buttonText === "Retrait" || buttonText === "Remise") {
    response = await sendRequest(`${serverUrl}/PresencePC`, {
      state: buttonText,
      mac: qrCodeData,
    });
  } else {
    reloadPage();
    return;
  }
  return response;
}

// Fonction pour recharger la page
function reloadPage() {
  window.location.reload(true);
}
