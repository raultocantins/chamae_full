/*
 * JavaScript client-side example using jsrsasign
 */

// #########################################################
// #             WARNING   WARNING   WARNING               #
// #########################################################
// #                                                       #
// # This file is intended for demonstration purposes      #
// # only.                                                 #
// #                                                       #
// # It is the SOLE responsibility of YOU, the programmer  #
// # to prevent against unauthorized access to any signing #
// # functions.                                            #
// #                                                       #
// # Organizations that do not protect against un-         #
// # authorized signing will be black-listed to prevent    #
// # software piracy.                                      #
// #                                                       #
// # -QZ Industries, LLC                                   #
// #                                                       #
// #########################################################

/**
 * Depends:
 *     - jsrsasign-latest-all-min.js
 *     - qz-tray.js
 *
 * Steps:
 *
 *     1. Include jsrsasign 8.0.4 into your web page
 *        <script src="https://cdn.rawgit.com/kjur/jsrsasign/c057d3447b194fa0a3fdcea110579454898e093d/jsrsasign-all-min.js"></script>
 *
 *     2. Update the privateKey below with contents from private-key.pem
 *
 *     3. Include this script into your web page
 *        <script src="path/to/sign-message.js"></script>
 *
 *     4. Remove or comment out any other references to "setSignaturePromise"
 *
 *  https://slproweb.com/products/Win32OpenSSL.html
 *
 *  openssl req -x509 -newkey rsa:2048 -keyout key.pem -out cert.pem -days 11499 -nodes
 */
 var privateKey = "-----BEGIN PRIVATE KEY-----\n" +
    "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDNBDGUL0IJdzaR\n" +
    "wVyahMpgXI9b2cfzxk9VnI7lRmZwaqHJ6bza8ruXpWffZjMq8GG5CRm64etz+7Vf\n" +
    "kGMQuhfTBPO7OG2HsDlduAurts1kkGFnHC7XAf9HyU6SL1CkZ/S16fCURHEIx7Le\n" +
    "j3p17114h6q93Gel4VtAefUqqMZzk78b7b6Ht8UXgnkAAPewM9/3muP7dLta8V/W\n" +
    "umbni2/GfzrN1zvan73uu90Z4i+k+gcgHlOmo8fPW1MtYQqE/jlIdHJO5F+bm8cc\n" +
    "uL21rEGzTdkZYE+4hOeatERSjxxGOXQKcWH7MGe4HnkaPdwy6oKAHxYJ/BPymKrx\n" +
    "2nelyWp9AgMBAAECggEAKRuL6GNQaa74Z2He1FHHdWphyWBBzkCndCpT4aeLz0Mm\n" +
    "RSLjngA5OpctHHd0z4mLAqvPN7BogmVIUQzVvEsgD00JJPNTzPb6Da9jUa8yAFXN\n" +
    "3fuh7bUmD2oPIdMwZ4K7p8UsWsJdas4F8MfSnXadJpeHVhHtS27EGgnKLZ9RSWeM\n" +
    "gT8s8fDbdKRv0TaeyusPU8aAoEe/KnfDaATDQLu2pd/OwziLzLb+FcQww+9bxdk/\n" +
    "e6dOGpjqWc6nd/S+vXiaMD8j/0v5AAixQUzFCDH0WiI2JBXI92v1MzwxQWZkkOpQ\n" +
    "TRjMz08oYp4RhTSunUWC6vpbmt360xjRFlCRJcfCAQKBgQD9APdcNDyoVmYm233o\n" +
    "sqLDHHZdT1j15Bdz7Mt+ntTLy1xBGxkY/TvBAsR3kfvEfr9AKS+5QvfVs/srOiYf\n" +
    "5tHDGZ53QP8f0aMTexLVMWRUQznz7E5OZvwrBOY5bBfYJ2oDifOcP1k46cb9NZIb\n" +
    "xtWfQ5zObK2pEmGJvE6Dx35IfQKBgQDPcb5d0tljvphB4eqCa/w+7WPrn8s6AyhW\n" +
    "KOdMqXVqEOXwArKzQXhyhB2R27nezSkJrjURLdHjASiPgFMkgyf0FtaPdHcwLKuQ\n" +
    "e3gNZ8jq7Yge5MRBAkQOusNcsifNXFb429Zo3mVzm+GH/t6ShSRWalaezwumqubb\n" +
    "o3oluWNKAQKBgHJvnHL1IbaWlc/fmbzGB/6ugg9Ek51s1PrXUVftaZzgV9MO+bQm\n" +
    "3n83zDu1KSbAmargtjhaxRTBOstbmuD1G03e6aFRIdR3kwZ9tY/+rj26xpzA9s5Z\n" +
    "oJeouKWiccqQUVBWdnzm3mlyvFHNiE/OCNPn1iY8W/RMXxfYt769Xi5VAoGAPP3/\n" +
    "b8yfuDEAyVYoQkKHvuTDXTL1aNAm2vZZ03N7nzzqrl/MtOHKDTmFDC6jfrupljwP\n" +
    "REbJkEn16ANd7r1VUPIqEbG3nYV0yB1VVfOu4kwGmra+cTK+WepVqHqFM18z/yV7\n" +
    "7Ad/orcxX2/zdvcIkRPg9f6AOXfEOs3dCxxv8gECgYA2iiw4t9Wt22e186u6nfRC\n" +
    "4NBq0re55x+IMVPdG45sDzzZU8S2/jCcNSQC007C2DlZ6Sy8W4aqL2I+Jf9u758O\n" +
    "Ui3wpfDxNigbtKox7TBeE1sw74MtVns9NBHyoH3iDmLw71IDjrxT5He89n4Cb6FR\n" +
    "xIxfuf1H1/VDmQqT614lxw==\n" +
    "-----END PRIVATE KEY-----";

qz.security.setSignatureAlgorithm("SHA512"); // Since 2.1
qz.security.setSignaturePromise(function(toSign) {
  return function(resolve, reject) {
      try {
          var pk = KEYUTIL.getKey(privateKey);
          var sig = new KJUR.crypto.Signature({"alg": "SHA512withRSA"});  // Use "SHA1withRSA" for QZ Tray 2.0 and older
          sig.init(pk);
          sig.updateString(toSign);
          var hex = sig.sign();
          console.log("DEBUG: \n\n" + stob64(hextorstr(hex)));
          resolve(stob64(hextorstr(hex)));
      } catch (err) {
          console.error(err);
          reject(err);
      }
  };
});
