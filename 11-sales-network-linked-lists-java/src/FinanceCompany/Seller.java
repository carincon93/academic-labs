package FinanceCompany;

public class Seller {
    String name;
    double membershipInititalFee = 1000 - (1000 * 0.10);
    double percentDiscount = 0.25;
    double smallestBallance = 0;
    double largestBallance = 0;
    SellerList sellerList;

    public Seller(String nameValue) {
        name = nameValue;
        sellerList = new SellerList();
    }

    void addSellerAssociated(Seller firstAssociatedSeller, double firstAssociatedSellerBalance, Seller secondAssociatedSeller, double secondAssociatedSellerBalance) {
        sellerList.insert(firstAssociatedSeller, secondAssociatedSeller);

        calculateBalance(firstAssociatedSellerBalance, secondAssociatedSellerBalance);

        calculateSmallestBalance(firstAssociatedSellerBalance, secondAssociatedSellerBalance);
    }

    void calculateBalance(double firstAssociatedSellerBalance, double secondAssociatedSellerBalance) {
        double total = 0;
        if(firstAssociatedSellerBalance > 0 && secondAssociatedSellerBalance > 0) {
            total = (percentDiscount * firstAssociatedSellerBalance) + (percentDiscount * secondAssociatedSellerBalance);
        } else {
            total = firstAssociatedSellerBalance * percentDiscount;
        }

        this.membershipInititalFee += total;
    }

    void calculateSmallestBalance(double firstAssociatedSellerBalance, double secondAssociatedSellerBalance) {
        if(firstAssociatedSellerBalance < secondAssociatedSellerBalance) {
            smallestBallance = firstAssociatedSellerBalance;
        } else {
            smallestBallance = secondAssociatedSellerBalance;
        }
    }
}
