import random

def generate_phone_number():
    # Génère un numéro de téléphone français aléatoire
    phone_number = "0"
    phone_number += str(random.randint(6, 7))  # Génère le premier chiffre (6 ou 7)
    phone_number += " "
    phone_number += str(random.randint(0, 9))  # Génère le deuxième chiffre
    phone_number += str(random.randint(0, 9))  # Génère le troisième chiffre
    phone_number += " "
    phone_number += str(random.randint(0, 9))  # Génère le premier groupe de deux chiffres
    phone_number += str(random.randint(0, 9))
    phone_number += " "
    phone_number += str(random.randint(0, 9))  # Génère le deuxième groupe de deux chiffres
    phone_number += str(random.randint(0, 9))
    phone_number += " "
    phone_number += str(random.randint(0, 9))  # Génère le troisième groupe de deux chiffres
    phone_number += str(random.randint(0, 9))
    phone_number += " "

    return phone_number

# Exemple d'utilisation
random_phone_number = generate_phone_number()
print(random_phone_number)
