package FinanceCompany;

public class Program {
    public static void main(String[] args) {
        Seller maria = new Seller("Maria");
        Seller luis = new Seller("Luis");
        Seller pedro = new Seller("Pedro");
        Seller pepito = new Seller("Pepito");
        Seller carlitos = new Seller("Carlitos");
        Seller fulanito = new Seller("Fulanito");
        Seller juan = new Seller("juan");
        Seller yenny = new Seller("yenny");
        Seller andrea = new Seller("andrea");

        carlitos.addSellerAssociated(yenny, yenny.membershipInititalFee, andrea, andrea.membershipInititalFee);
        pepito.addSellerAssociated(carlitos, carlitos.membershipInititalFee, juan, juan.membershipInititalFee);
        pedro.addSellerAssociated(pepito, pepito.membershipInititalFee, fulanito, fulanito.membershipInititalFee);
        maria.addSellerAssociated(luis, luis.membershipInititalFee, pedro, pedro.membershipInititalFee);

        System.out.println("Maria's balance: " + maria.membershipInititalFee);
        System.out.println("Smallest balance: " + Math.min(maria.smallestBallance, Math.min(pedro.smallestBallance, Math.min(pepito.smallestBallance, carlitos.smallestBallance))));
        System.out.println("Largest balance: " + Math.max(maria.membershipInititalFee, Math.max(pedro.membershipInititalFee, Math.max(pepito.membershipInititalFee, carlitos.membershipInititalFee))));
        double totalBalance = maria.membershipInititalFee + pedro.membershipInititalFee + pepito.membershipInititalFee + carlitos.membershipInititalFee;
        System.out.println("Total balance: " + totalBalance);
    }
}