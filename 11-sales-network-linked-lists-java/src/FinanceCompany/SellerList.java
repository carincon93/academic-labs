package FinanceCompany;

public class SellerList {
    SellerNode head;

    void insert(Seller firstAssociatedSeller, Seller secondAssociatedSeller) {
        SellerNode newNode = new SellerNode();

        newNode.firstSeller = firstAssociatedSeller;
        newNode.secondSeller = secondAssociatedSeller;

        if (head == null) {
            head = newNode;
        } else {
            SellerNode tmp = head;

            while (tmp.next != null) {
                tmp = tmp.next;
            }
            tmp.next = newNode;
        }
    }
}
