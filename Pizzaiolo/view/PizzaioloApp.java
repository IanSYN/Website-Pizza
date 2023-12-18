package view;
import javax.swing.*;

public class PizzaioloApp {

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            JFrame frame = new JFrame("Pizzaiolo App");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

            VCuisineDetail cuisineDetail = new VCuisineDetail();
            frame.getContentPane().add(cuisineDetail);

            frame.setSize(1080, 720);
            frame.setLocationRelativeTo(null);
            frame.setResizable(false);
            frame.setVisible(true);
        });
    }
}
