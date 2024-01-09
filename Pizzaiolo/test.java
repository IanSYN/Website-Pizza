public class test {

    public test() {
    }

    public void codePromo(){
        //génération du code promo aleatoire et insert to base de donnée
        String codePromo = "";
        for (int i = 0; i < 8; i++) {
            int random = (int) (Math.random() * 26);
            codePromo += (char) (random + 65);
        }
        // String query = "INSERT INTO `Coupon`(`codeCoupon`, 'datePeremptionCoupon', `idClient`) VALUES ('" + codePromo + "', null, null')";
        // OutilsJDBC.ExecuteurSQL(query);
        System.out.println("Votre code promo est : " + codePromo);
    }

    public static void main(String[] args) {
        test c = new test();
        c.codePromo();
    }
}

