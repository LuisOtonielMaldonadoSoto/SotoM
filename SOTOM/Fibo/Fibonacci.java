package Fibo;

import java.awt.EventQueue;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

public class Fibonacci extends JFrame {

	int x,y,valor3;
	int valor1 = 0;
	int valor2 = 1;
	String Texto = "";
	private JPanel contentPane;
	private JTextField textField;
	private JTextField textField_1;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Fibonacci frame = new Fibonacci();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Fibonacci() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 225);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JButton btnNewButton = new JButton("Calcular");
		btnNewButton.setBounds(254, 36, 151, 55);
		contentPane.add(btnNewButton);
		
		JLabel lblNewLabel = new JLabel("Valor Inicial");
		lblNewLabel.setBounds(10, 36, 78, 36);
		contentPane.add(lblNewLabel);
		
		JLabel lblNewLabel_1 = new JLabel("Valor Final");
		lblNewLabel_1.setBounds(10, 74, 78, 24);
		contentPane.add(lblNewLabel_1);
		
		textField = new JTextField();
		textField.setBounds(84, 45, 96, 19);
		contentPane.add(textField);
		textField.setColumns(10);
		
		textField_1 = new JTextField();
		textField_1.setBounds(84, 71, 96, 19);
		contentPane.add(textField_1);
		textField_1.setColumns(10);
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				if(textField.getText() != "")
				{
					x = Integer.parseInt(textField.getText());
					JOptionPane.showMessageDialog(null, "Valores iniciales 0,1","Resultado", JOptionPane.INFORMATION_MESSAGE);
					do
			        {
			        y = y+1;
			        valor3 = valor1 + valor2;
			        JOptionPane.showMessageDialog(null, "Iteracion "+ y +" Valor "+ valor3, "Resultado", JOptionPane.INFORMATION_MESSAGE);
			        valor1=valor2;
			        valor2=valor3;
			        
			        }
			        while(y < x);
					
				}
			}
		});
	}

}
