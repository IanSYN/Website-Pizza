import random

def generate_phone_number_zero():
    # Génère un numéro de téléphone français 06 ou 07 aléatoire
    phone_number = "0"
    phone_number += str(random.randint(6, 7))  # Génère le premier chiffre (6 ou 7)
    phone_number += str(random.randint(0, 9))  # Génère le deuxième chiffre
    phone_number += str(random.randint(0, 9))  # Génère le troisième chiffre
    phone_number += str(random.randint(0, 9))  # Génère le premier groupe de deux chiffres
    phone_number += str(random.randint(0, 9))
    phone_number += str(random.randint(0, 9))  # Génère le deuxième groupe de deux chiffres
    phone_number += str(random.randint(0, 9))
    phone_number += str(random.randint(0, 9))  # Génère le troisième groupe de deux chiffres
    phone_number += str(random.randint(0, 9))

    return phone_number

def generate_phone_number_33():
    # Génère un numéro de téléphone français +336 ou +337 aléatoire
    phone_number = "+33"
    phone_number += str(random.randint(6, 7))  # Génère le premier chiffre (6 ou 7)
    phone_number += str(random.randint(0, 9))  # Génère le deuxième chiffre
    phone_number += str(random.randint(0, 9))  # Génère le troisième chiffre
    phone_number += str(random.randint(0, 9))  # Génère le premier groupe de deux chiffres
    phone_number += str(random.randint(0, 9))
    phone_number += str(random.randint(0, 9))  # Génère le deuxième groupe de deux chiffres
    phone_number += str(random.randint(0, 9))
    phone_number += str(random.randint(0, 9))  # Génère le troisième groupe de deux chiffres
    phone_number += str(random.randint(0, 9))

    return phone_number

# Exemple d'utilisation
random_phone_number = generate_phone_number_zero()
print(random_phone_number)

random_phone_number_cas2 = generate_phone_number_33()
print(random_phone_number_cas2)
