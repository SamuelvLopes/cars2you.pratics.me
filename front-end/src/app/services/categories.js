import axios from 'axios';
import { env } from '../config/env';

const baseUrl = `${env.apiUrl}/api/categories`;

export const getAllCategories = async () => {
  const request = await axios.get(baseUrl);
  return request.data;
};
