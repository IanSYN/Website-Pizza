package Config;

import java.sql.*;

public class OutilsJDBC {
    public static Connection openConnection(String url) {
        Connection co = null;
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            co = DriverManager.getConnection(url, "saes3pizzavers", "zltFcWcsZds/SMCK");
        } catch (ClassNotFoundException e) {
            System.out.println("il manque le driver mysql");
            System.exit(1);
        } catch (SQLException e) {
            System.out.println("impossible de se connecter à l'url : " + url);
            System.exit(1);
        }
        return co;
    }

    public static ResultSet exec1Requete(String requete, Connection co, int type) {
        ResultSet res = null;
        try {
            Statement st;
            if (type == 0) {
                st = co.createStatement();
            } else {
                st = co.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE,
                        ResultSet.CONCUR_READ_ONLY);
            }
            res = st.executeQuery(requete);
        } catch (SQLException e) {
            System.out.println("Problème lors de l'exécution de la requete : " + requete);
        }
        return res;
    }

    public static void closeConnection(Connection co) {
        try {
            co.close();
            System.out.println("Connexion fermée!");
        } catch (SQLException e) {
            System.out.println("Impossible de fermer la connexion");
        }
    }

    public static void affichage(ResultSet rs) {
        try {
            while (rs.next()) {
                for (int i = 1; i <= 3; i++) {
                    System.out.println(rs.getString(i) + "\t");
                }
                System.out.println(" ");
            }
        } catch (SQLException e) {
            System.out.println("Error while fetching data: " + e.getMessage());
        }
    }

    public static void main(String[] args) {
        String url = "jdbc:mysql://localhost:3306/saes3pizzavers";
        Connection co = OutilsJDBC.openConnection(url);
        String query = "SELECT * FROM VPizza";
        ResultSet rs = OutilsJDBC.exec1Requete(query, co, 1);
        OutilsJDBC.affichage(rs);

        OutilsJDBC.closeConnection(co);
    };}
