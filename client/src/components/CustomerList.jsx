import { useState, useEffect } from 'react';
import axios from 'axios';
import './CustomerList.css';

const CustomerList = () => {
  const [customers, setCustomers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchCustomers = async () => {
      try {
        const response = await axios.get(`${process.env.REACT_APP_API_URL}/customers`);
        setCustomers(response.data);
        setLoading(false);
      } catch (error) {
        setError(error);
        setLoading(false);
      }
    };

    fetchCustomers();

  }, []);

  if (loading) {
    return <p>Loading...</p>;
  }

  if (error) {
    return <p>Error: Failed to fetch customers. Please try again later.</p>;
  }

  return (
    <div>
      <h2>Customers</h2>
      <ul>
        {customers.map(customer => (
          <li key={customer.id}>
            <strong>Name:</strong> {customer.name} <br />
            <strong>Points:</strong> {customer.points}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default CustomerList;
